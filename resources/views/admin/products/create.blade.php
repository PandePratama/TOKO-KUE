@extends('layouts.admin') {{-- sesuaikan dengan layout SB Admin 2 kamu --}}

@section('title', 'Tambah Produk')

@section('content')
<div class="container-fluid">

    {{-- Page Heading --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Produk</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Error Alert --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Card --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Produk</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama Produk --}}
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama produk"
                        required>
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control"
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Deskripsi produk">{{ old('description') }}</textarea>
                </div>

                {{-- Harga --}}
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number"
                        class="form-control"
                        id="price"
                        name="price"
                        value="{{ old('price') }}"
                        placeholder="Masukkan harga"
                        required>
                </div>

                {{-- Stok --}}
                <div class="form-group">
                    <label for="stock_quantity">Stok</label>
                    <input type="number"
                        class="form-control"
                        id="stock_quantity"
                        name="stock_quantity"
                        value="{{ old('stock_quantity') }}"
                        placeholder="Jumlah stok"
                        required>
                </div>

                {{-- Gambar --}}
                <div class="form-group">
                    <label for="image">Gambar Produk</label>
                    <input type="file"
                        class="form-control-file"
                        id="image"
                        name="image"
                        accept="image/*">
                </div>

                {{-- Button --}}
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection