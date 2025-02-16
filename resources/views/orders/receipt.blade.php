@extends('layouts.app')

@section('title', 'Bukti Layanan')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white text-center">
            <h5 class="mb-0">Bukti Layanan Laundry</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th>Kode Pesanan</th>
                    <td>: {{ $order->order_code }}</td>
                </tr>
                <tr>
                    <th>Pelanggan</th>
                    <td>: {{ $order->customer->name }}</td>
                </tr>
                <tr>
                    <th>Layanan</th>
                    <td>: {{ $order->service->service_name }}</td>
                </tr>
                <tr>
                    <th>Jumlah (Kg)</th>
                    <td>: {{ $order->weight }} Kg</td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td>: Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>: {{ $order->status->status_name }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>: {{ $order->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            </table>

            <div class="text-center mt-4">
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="fas fa-print"></i> Cetak
                </button>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
