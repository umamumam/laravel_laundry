@extends('layouts.app')

@section('title', 'Tambah Layanan')

@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Layanan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('services.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-cog"></i> Nama Layanan</label>
                            <input type="text" name="service_name" class="form-control" placeholder="Masukkan nama layanan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-dollar-sign"></i> Harga</label>
                            <input type="number" name="price" class="form-control" placeholder="Masukkan harga" required>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('services.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
