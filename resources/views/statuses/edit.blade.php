@extends('layouts.app')

@section('title', 'Edit Status Laundry')

@section('content')
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h6><i class="fas fa-edit me-2"></i> Edit Status Laundry</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('statuses.update', $status->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Status</label>
                    <input type="text" name="status_name" value="{{ $status->status_name }}" class="form-control @error('status_name') is-invalid @enderror">
                    @error('status_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Update</button>
                <a href="{{ route('statuses.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </form>
        </div>
    </div>
@endsection
