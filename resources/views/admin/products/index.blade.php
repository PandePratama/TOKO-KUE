@extends('admin.layouts.admin')

@section('title', 'Data Produk')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Data Produk</h1>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Tombol Tambah dan Pencarian --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>

        <form action="{{ route('admin.products.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2"
                placeholder="Cari nama produk..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>
    </div>

    {{-- Tabel Produk --}}
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $product->stock_quantity }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.products.show', $product->id) }}"
                                    class="btn btn-info btn-sm me-1">
                                    <i class="fas fa-eye"></i> Detail
                                </a>

                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                    class="btn btn-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('admin.products.destroy', $product->id) }}"
                                    method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">
                                Belum ada produk yang tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection