@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
    @if (session('success'))
        <div class="alert alert-success" id="success-alert">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" id="error-alert">{{ session('error') }}</div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center bg-info text-white">
                    <h6 class="mb-0 text-white"><i class="bi bi-cart-fill fs-3 text-white"></i> Daftar Pesanan</h6>
                    <a href="{{ route('orders.create') }}" class="btn btn-light">Tambah Pesanan</a>
                </div>
                <div class="card-body">
                    <!-- Form Pencarian -->
                    <form action="{{ route('orders.index') }}" method="GET" class="mb-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-flex align-items-center" style="gap: 6px;">
                                <div class="input-group" style="max-width: 150px;">
                                    <input type="date" name="tgl_masuk_awal" class="form-control form-control-sm"
                                        value="{{ request('tgl_masuk_awal') }}">
                                </div>
                                <div class="input-group" style="max-width: 150px;">
                                    <input type="date" name="tgl_masuk_akhir" class="form-control form-control-sm"
                                        value="{{ request('tgl_masuk_akhir') }}">
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary"
                                    style="margin-top: 10px;">Filter</button>
                            </div>


                            <form action="{{ route('orders.index') }}" method="GET" class="mb-1">
                                <div class="input-group" style="max-width: 250px;">
                                    <span class="input-group-text text-body">
                                        <i class="fas fa-search" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" name="search" class="form-control" placeholder="Cari pesanan..."
                                        value="{{ request('search') }}">
                                </div>
                            </form>
                        </div>
                    </form>
                    <a href="{{ route('orders.export-view') }}" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>

                    <div class="table-responsive p-3">
                        <table class="table table-hover table-striped align-items-center">
                            <thead style="background-color: #8bff74; color: white;">
                                <tr>
                                    <th class="text-center">
                                        <input type="checkbox" id="select-all">
                                    </th>
                                    <th>Kode</th>
                                    <th>Pelanggan</th>
                                    <th>Layanan</th>
                                    <th>Jumlah (Kg)</th>
                                    <th>Jumlah Item</th>
                                    <th>Total Harga</th>
                                    <th>Tgl Masuk</th>
                                    <th>Tgl Selesai</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr data-order-id="{{ $order->id }}">
                                        <td class="text-center">
                                            <input type="checkbox" class="order-checkbox" value="{{ $order->id }}">
                                        </td>
                                        <td>{{ $order->order_code }}</td>
                                        <td>{{ $order->customer->name }}</td>
                                        <td>{{ $order->service->service_name }}</td>
                                        <td>{{ $order->quantity }} Kg</td>
                                        <td>{{ $order->jumlah_item }}</td>
                                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->tgl_masuk)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->tgl_selesai)->format('d-m-Y') }}</td>
                                        <td class="status-text">{{ $order->status->status_name }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                                    data-bs-toggle="dropdown">
                                                    Aksi
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('orders.edit', $order->id) }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('orders.pdf', $order->id) }}">
                                                            <i class="fas fa-file-pdf"></i> PDF
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('orders.destroy', $order->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fas fa-trash-alt"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Tombol di Bawah -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-info" id="update-status">
                            <i class="fas fa-sync"></i> Ubah Status Terpilih
                        </button>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Menampilkan {{ $orders->firstItem() }} - {{ $orders->lastItem() }} dari
                            {{ $orders->total() }} pesanan
                        </div>
                        <nav>
                            <ul class="pagination pagination-sm mb-0">
                                {{-- Tombol Previous --}}
                                @if ($orders->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">«</span></li>
                                @else
                                    <li class="page-item"><a class="page-link bg-primary text-white"
                                            href="{{ $orders->previousPageUrl() }}" rel="prev">«</a></li>
                                @endif

                                {{-- Nomor Halaman --}}
                                @foreach ($orders->links()->elements[0] ?? [] as $page => $url)
                                    @if ($page == $orders->currentPage())
                                        <li class="page-item active"><span
                                                class="page-link bg-primary border-primary">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link text-primary"
                                                href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach

                                {{-- Tombol Next --}}
                                @if ($orders->hasMorePages())
                                    <li class="page-item"><a class="page-link bg-primary text-white"
                                            href="{{ $orders->nextPageUrl() }}" rel="next">»</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">»</span></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    @php
                        $totalTransaksi = $orders->total();
                        $totalPendapatan = $orders->sum('total_price');
                    @endphp

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Transaksi</h5>
                                    <p class="card-text fs-4">{{ $totalTransaksi }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Pendapatan</h5>
                                    <p class="card-text fs-4">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Pilih semua checkbox
        $('#select-all').on('click', function() {
            $('.order-checkbox').prop('checked', this.checked);
        });

        // AJAX untuk Update Status
        $('#update-status').on('click', function() {
            let selectedOrders = [];
            $('.order-checkbox:checked').each(function() {
                selectedOrders.push($(this).val());
            });

            if (selectedOrders.length === 0) {
                alert("Pilih minimal satu pesanan!");
                return;
            }

            selectedOrders.forEach(orderId => {
                $.ajax({
                    url: "/orders/" + orderId + "/update-status",
                    type: "PATCH",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            let row = $(`tr[data-order-id="${orderId}"]`);
                            row.find('.status-text').text(response.new_status);
                        }
                    },
                    error: function() {
                        alert("Terjadi kesalahan, coba lagi.");
                    }
                });
            });

        });
    </script>
@endsection
