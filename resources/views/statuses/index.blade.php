@extends('layouts.app')

@section('title', 'Daftar Status Laundry')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h6 class="mb-0"><i class="fas fa-sync-alt me-2"></i> Daftar Status Laundry</h6>
                    <a href="{{ route('statuses.create') }}" class="btn btn-light">
                        <i class="fas fa-plus"></i> Tambah Status
                    </a>
                </div>
                <div class="card-body">
                    <!-- Form Pencarian -->
                    <form action="{{ route('statuses.index') }}" method="GET" class="mb-1">
                        <div class="d-flex justify-content-end">
                            <div class="input-group" style="max-width: 250px;">
                                <span class="input-group-text text-body">
                                    <i class="fas fa-search" aria-hidden="true"></i>
                                </span>
                                <input type="text" name="search" class="form-control" placeholder="Cari status..." value="{{ request('search') }}">
                            </div>
                        </div>
                    </form>
                    
                    <!-- Tabel Status -->
                    <div class="table-responsive p-3">
                        <table class="table table-hover table-striped align-items-center">
                            <thead style="background-color: #4fdcff; color: white;">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($statuses as $status)
                                    <tr>
                                        <td class="text-center font-weight-bold">{{ $loop->iteration + ($statuses->currentPage() - 1) * $statuses->perPage() }}</td>
                                        <td>{{ $status->status_name }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('statuses.edit', $status->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('statuses.destroy', $status->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Menampilkan {{ $statuses->firstItem() }} - {{ $statuses->lastItem() }} dari {{ $statuses->total() }} status
                        </div>
                        <nav>
                            <ul class="pagination pagination-sm mb-0">
                                {{-- Tombol Previous --}}
                                @if ($statuses->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">«</span></li>
                                @else
                                    <li class="page-item"><a class="page-link bg-primary text-white" href="{{ $statuses->previousPageUrl() }}" rel="prev">«</a></li>
                                @endif
                    
                                {{-- Nomor Halaman --}}
                                @foreach ($statuses->links()->elements[0] ?? [] as $page => $url)
                                    @if ($page == $statuses->currentPage())
                                        <li class="page-item active"><span class="page-link bg-primary border-primary">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link text-primary" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                    
                                {{-- Tombol Next --}}
                                @if ($statuses->hasMorePages())
                                    <li class="page-item"><a class="page-link bg-primary text-white" href="{{ $statuses->nextPageUrl() }}" rel="next">»</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">»</span></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
