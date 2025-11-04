@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Produk</h1>

    <div class="card" style="width: 24rem;">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <p class="card-text">Stok: {{ $product->stock }}</p>
            <p class="card-text">{{ $product->description ?? 'Tidak ada deskripsi' }}</p>
        </div>
    </div>

    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-success">Tambah ke Cart</button>
    </form>

    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection