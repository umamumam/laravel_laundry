@extends('layouts.app')

@section('title', 'Cek Status Pesanan')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5><i class="fas fa-search"></i> Cek Status Pesanan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.check') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="order_code" class="form-label">Masukkan Kode Pesanan</label>
                        <input type="text" name="order_code" id="order_code" class="form-control"
                            placeholder="Contoh: ORD-12345" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cek Status</button>
                </form>
            </div>
        </div>

        @if (isset($order))
            <div class="card mt-3">
                <div class="card-header bg-success text-white">
                    <h5><i class="fas fa-info-circle"></i> Hasil Pencarian</h5>
                </div>
                <div class="card-body">
                    <p><strong>Kode Pesanan:</strong> {{ $order->order_code }}</p>
                    <p><strong>Nama Pelanggan:</strong> {{ $order->customer->name }}</p>
                    <p><strong>Layanan:</strong> {{ $order->service->service_name }}</p>
                    <p><strong>Jumlah:</strong> {{ $order->quantity }} Kg</p>
                    <p><strong>Total Harga:</strong> Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    <p><strong>Tanggal Masuk:</strong> {{ \Carbon\Carbon::parse($order->tgl_masuk)->format('d-m-Y') }}</p>
                    <p><strong>Status:</strong> <span class="badge bg-warning">{{ $order->status->status_name }}</span></p>
                </div>
            </div>
        @elseif (isset($not_found))
            <div class="alert alert-danger mt-3">
                <i class="fas fa-exclamation-triangle"></i> Data tidak ditemukan! Pastikan kode pesanan yang dimasukkan benar.
            </div>
        @endif
    </div>
@endsection
