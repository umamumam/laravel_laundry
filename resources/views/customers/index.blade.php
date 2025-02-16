@extends('layouts.app')

@section('title', 'Daftar Pelanggan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h6 class="mb-0">Daftar Pelanggan</h6>
                    <a href="{{ route('customers.create') }}" class="btn btn-light">Tambah Pelanggan</a>
                </div>
                <div class="card-body">
                    <!-- Form Pencarian -->
                    <form action="{{ route('customers.index') }}" method="GET" class="mb-1">
                        <div class="d-flex justify-content-end">
                            <div class="input-group" style="max-width: 250px;">
                                <span class="input-group-text text-body">
                                    <i class="fas fa-search" aria-hidden="true"></i>
                                </span>
                                <input type="text" name="search" class="form-control" placeholder="Cari pelanggan..."
                                    value="{{ request('search') }}">
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive p-3">
                        <table class="table table-hover table-striped align-items-center">
                            <thead style="background-color: #ffc14f; color: white;">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Avatar</th>
                                    <th>Nama</th>
                                    <th>No. HP</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td class="text-center font-weight-bold">{{ $loop->iteration + ($customers->currentPage() - 1) * $customers->perPage() }}</td>
                                        <td class="text-center">
                                            <img src="https://i.pravatar.cc/50?u={{ $customer->id }}" class="rounded-circle" alt="avatar">
                                        </td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
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
                            Menampilkan {{ $customers->firstItem() }} - {{ $customers->lastItem() }} dari {{ $customers->total() }} pelanggan
                        </div>
                        <nav>
                            <ul class="pagination pagination-sm mb-0">
                                {{-- Tombol Previous --}}
                                @if ($customers->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">«</span></li>
                                @else
                                    <li class="page-item"><a class="page-link bg-primary text-white" href="{{ $customers->previousPageUrl() }}" rel="prev">«</a></li>
                                @endif
                    
                                {{-- Nomor Halaman --}}
                                @foreach ($customers->links()->elements[0] ?? [] as $page => $url)
                                    @if ($page == $customers->currentPage())
                                        <li class="page-item active"><span class="page-link bg-primary border-primary">{{ $page }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link text-primary" href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                    
                                {{-- Tombol Next --}}
                                @if ($customers->hasMorePages())
                                    <li class="page-item"><a class="page-link bg-primary text-white" href="{{ $customers->nextPageUrl() }}" rel="next">»</a></li>
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
