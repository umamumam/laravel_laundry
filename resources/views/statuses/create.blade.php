@extends('layouts.app')

@section('title', 'Tambah Status Laundry')

@section('content')
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h6><i class="fas fa-plus-circle me-2"></i> Tambah Status Laundry</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('statuses.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Status</label>
                    <input type="text" name="status_name" class="form-control @error('status_name') is-invalid @enderror" placeholder="Masukkan nama status">
                    @error('status_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('statuses.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </form>
        </div>
    </div>
@endsection
