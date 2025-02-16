@extends('layouts.app')

@section('title', 'Edit Pesanan')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Pesanan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kode Pesanan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                <input type="text" name="order_code" class="form-control bg-light" 
                                       value="{{ $order->order_code }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="service_id" class="col-12 form-label fw-semibold">Layanan</label>
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-basket-shopping"></i></span>
                                    <select name="service_id" id="service_id" class="form-select select2">
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" data-price="{{ $service->price }}" 
                                                {{ $service->id == $order->service_id ? 'selected' : '' }}>
                                                {{ $service->service_name }} - Rp {{ number_format($service->price, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Masuk</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="date" name="tgl_masuk" class="form-control" 
                                       value="{{ \Carbon\Carbon::parse($order->tgl_masuk)->format('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="mb-3 row">
                            <label for="customer_id" class="col-md-3 form-label">Pelanggan</label>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <select name="customer_id" id="customer_id" class="form-select select2">
                                        <option value="">-- Pilih Pelanggan --</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}" 
                                                {{ $customer->id == $order->customer_id ? 'selected' : '' }}>
                                                {{ $customer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Kolom Jumlah (Kg) -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Jumlah (Kg)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-weight-hanging"></i></span>
                                        <input type="number" name="quantity" id="quantity" class="form-control" 
                                               value="{{ $order->quantity }}" min="1" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Kolom Jumlah Item -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Jumlah Item</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-boxes"></i></span>
                                        <input type="number" name="jumlah_item" class="form-control" 
                                               value="{{ $order->jumlah_item }}" min="1" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                <input type="date" name="tgl_selesai" class="form-control" 
                                       value="{{ $order->tgl_selesai ? \Carbon\Carbon::parse($order->tgl_selesai)->format('Y-m-d') : '' }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Harga di Bawah -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Total Harga</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                        <input type="text" id="total_price" name="total_price" class="form-control bg-light fw-bold text-end" 
                               value="{{ number_format($order->total_price, 0, ',', '.') }}" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status_id" class="form-select">
                        @foreach($statuses as $status)
                            <option value="{{ $status->id }}" 
                                {{ $status->id == $order->status_id ? 'selected' : '' }}>
                                {{ $status->status_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Include jQuery dan Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <script>
        $(document).ready(function() {
            $('#customer_id').select2({
                placeholder: "-- Pilih Pelanggan --",
                allowClear: true,
                width: '100%'
            });

            $('#service_id').select2({
                placeholder: "-- Pilih Layanan --",
                allowClear: true,
                width: '100%'
            });

            function updateTotalPrice() {
                let quantity = document.getElementById('quantity').value;
                let service = document.getElementById('service_id');
                let price = service.options[service.selectedIndex].getAttribute('data-price');

                if (quantity > 0) {
                    document.getElementById('total_price').value = new Intl.NumberFormat('id-ID').format(quantity * price);
                } else {
                    document.getElementById('total_price').value = 0;
                }
            }

            document.getElementById('quantity').addEventListener('input', updateTotalPrice);
            document.getElementById('service_id').addEventListener('change', updateTotalPrice);
        });
    </script>
@endsection
