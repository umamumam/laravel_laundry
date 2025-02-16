@extends('layouts.app')

@section('title', 'Edit Layanan')

@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Edit Layanan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('services.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-cog"></i> Nama Layanan</label>
                            <input type="text" name="service_name" class="form-control" value="{{ $service->service_name }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-dollar-sign"></i> Harga</label>
                            <input type="number" name="price" class="form-control" value="{{ $service->price }}" required>
                        </div>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Update
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
