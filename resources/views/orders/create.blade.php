@extends('layouts.app')

@section('title', 'Tambah Pesanan')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i> Tambah Pesanan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Kode Pesanan</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                <input type="text" name="order_code" class="form-control bg-light" 
                                    value="{{ 'ORD-' . strtoupper(Str::random(6)) }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="service_id" class="col-12 form-label fw-semibold">Layanan</label>
                            <div class="col-12">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-basket-shopping"></i></span>
                                    <select name="service_id" id="service_id" class="form-select select2">
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" data-price="{{ $service->price }}">
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
                                <input type="date" name="tgl_masuk" class="form-control" value="{{ old('tgl_masuk', now()->format('Y-m-d')) }}" required>
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
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Jumlah (Kg)</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-weight-hanging"></i></span>
                                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Jumlah Item</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-boxes"></i></span>
                                        <input type="number" name="jumlah_item" class="form-control" min="1" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="mb-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                                <input type="date" name="tgl_selesai" class="form-control" value="{{ old('tgl_selesai') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Harga di Kanan -->
                <div class="d-flex justify-content-end">
                    <div style="max-width: 300px; width: 100%;">
                        <label class="form-label fw-bold">Total Harga</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                            <input type="text" id="total_price" name="total_price" class="form-control bg-light fw-bold text-end" readonly>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="status_id" value="1"> 

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <script>
        $(document).ready(function() {
            $('#customer_id').select2({
                placeholder: "-- Pilih Pelanggan --",
                allowClear: true,
                width: '100%',
                width: 'resolve'
            });
            $('#service_id').select2({
                placeholder: "-- Pilih Layanan --",
                allowClear: true,
                width: '100%',
                width: 'resolve'
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
