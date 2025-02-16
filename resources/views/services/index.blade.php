@extends('layouts.app')

@section('title', 'Daftar Layanan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h6 class="mb-0"><i class="fas fa-concierge-bell me-2"></i> Daftar Layanan</h6>
                    <a href="{{ route('services.create') }}" class="btn btn-light">
                        <i class="fas fa-plus"></i> Tambah Layanan
                    </a>
                </div>
                <div class="card-body">
                    <!-- Form Pencarian -->
                    <form action="{{ route('services.index') }}" method="GET" class="mb-3">
                        <div class="d-flex justify-content-end">
                            <div class="input-group" style="max-width: 250px;">
                                <span class="input-group-text text-body">
                                    <i class="fas fa-search" aria-hidden="true"></i>
                                </span>
                                <input type="text" name="search" class="form-control" placeholder="Cari layanan..."
                                    value="{{ request('search') }}">
                            </div>
                        </div>
                    </form>

                    <!-- Tabel Layanan -->
                    <div class="table-responsive p-3">
                        <table class="table table-hover table-striped align-items-center">
                            <thead style="background-color: #4fdcff; color: white;">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nama Layanan</th>
                                    <th>Harga</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td class="text-center font-weight-bold">{{ $loop->iteration + ($services->currentPage() - 1) * $services->perPage() }}</td>
                                        <td>{{ $service->service_name }}</td>
                                        <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
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
                            Menampilkan {{ $services->firstItem() }} - {{ $services->lastItem() }} dari {{ $services->total() }} layanan
                        </div>
                        <nav>
                            <ul class="pagination pagination-sm mb-0">
                                {{-- Tombol Previous --}}
                                @if ($services->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">«</span></li>
                                @else
                                    <li class="page-item"><a class="page-link bg-primary text-white" href="{{ $services->previousPageUrl() }}" rel="prev">«</a></li>
                                @endif
                    
                                {{-- Nomor Halaman --}}
                                @foreach ($services->links()->elements[0] ?? [] as $page => $url)
                                    @if ($page == $services->currentPage())
                                        <li class="page-item active"><span class="page-link bg-primary border-primary">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link text-primary" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                    
                                {{-- Tombol Next --}}
                                @if ($services->hasMorePages())
                                    <li class="page-item"><a class="page-link bg-primary text-white" href="{{ $services->nextPageUrl() }}" rel="next">»</a></li>
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
