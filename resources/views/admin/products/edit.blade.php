@extends('layouts.admin') {{-- sesuaikan dengan layout SB Admin 2 kamu --}}

@section('title', 'Edit Produk')

@section('content')
<div class="container-fluid">

    {{-- Page Heading --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Produk</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Error Validation --}}
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
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Produk</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama Produk --}}
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                        required>
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control"
                        id="description"
                        name="description"
                        rows="4">{{ old('description', $product->description) }}</textarea>
                </div>

                {{-- Harga --}}
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number"
                        class="form-control"
                        id="price"
                        name="price"
                        value="{{ old('price', $product->price) }}"
                        required>
                </div>

                {{-- Stok --}}
                <div class="form-group">
                    <label for="stock_quantity">Stok</label>
                    <input type="number"
                        class="form-control"
                        id="stock_quantity"
                        name="stock_quantity"
                        value="{{ old('stock_quantity', $product->stock_quantity) }}"
                        required>
                </div>

                {{-- Gambar Produk --}}
                <div class="form-group">
                    <label>Gambar Produk</label>

                    @if ($product->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="img-thumbnail"
                            style="max-width: 150px;">
                    </div>
                    @else
                    <p class="text-muted">Belum ada gambar</p>
                    @endif

                    <input type="file"
                        class="form-control-file"
                        name="image"
                        accept="image/*">

                    <small class="form-text text-muted">
                        Kosongkan jika tidak ingin mengganti gambar.
                    </small>
                </div>

                {{-- Button --}}
                <div class="text-right">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection