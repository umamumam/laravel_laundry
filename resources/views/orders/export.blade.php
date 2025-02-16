@extends('layouts.app')

@section('title', 'Export Data Pesanan')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5><i class="fas fa-file-excel"></i> Export Data Pesanan</h5>
            </div>
            <div class="card-body">
                <p>Silakan klik tombol di bawah untuk mengunduh data pesanan dalam format Excel.</p>

                <a href="{{ route('orders.download-excel') }}" class="btn btn-success">
                    <i class="fas fa-download"></i> Download Excel
                </a>
            </div>
        </div>
    </div>
@endsection
