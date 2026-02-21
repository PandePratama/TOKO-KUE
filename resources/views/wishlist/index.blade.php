@extends('layouts.main')

@section('title', 'Wishlist - JajanSnack')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Wishlist Saya</h3>
        <span class="text-muted">{{ $wishlists->total() }} Produk</span>
    </div>

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @elseif (session('info'))
        <div class="alert alert-info alert-dismissible fade show">
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($wishlists->count() > 0)

    <div class="row g-4">
        @foreach($wishlists as $wishlist)
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100 wishlist-card">

                <div class="card-body d-flex gap-4 align-items-center">

                    {{-- Gambar --}}
                    <div class="position-relative">
                        <img src="{{ Storage::url($wishlist->product->primaryImage->image_path) }}"
                            alt="{{ $wishlist->product->name }}"
                            class="rounded-3"
                            style="width:120px;height:140px;object-fit:cover;">
                    </div>

                    {{-- Detail --}}
                    <div class="flex-grow-1">

                        <h5 class="fw-semibold mb-2">
                            {{ $wishlist->product->name }}
                        </h5>

                        <div class="fw-bold text-danger fs-5 mb-3">
                            Rp {{ number_format($wishlist->product->price, 0, ',', '.') }}
                        </div>

                        <div class="d-flex gap-2">

                            {{-- Lihat Produk --}}
                            <a href="{{ route('product.detail', $wishlist->product->id) }}"
                                class="btn btn-outline-secondary btn-sm rounded-3">
                                <i class="bi bi-eye me-1"></i> Lihat
                            </a>

                            {{-- Tambah ke Keranjang --}}
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $wishlist->product->id }}">
                                <input type="hidden" name="quantity" value="20">
                                <button type="submit"
                                    class="btn btn-sm text-white rounded-3"
                                    style="background-color:#b45309;">
                                    <i class="bi bi-cart me-1"></i> Add to Cart
                                </button>
                            </form>

                            {{-- Hapus Wishlist --}}
                            <form action="{{ route('wishlist.remove', $wishlist->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-sm btn-outline-danger rounded-3">
                                    <i class="bi bi-heart-fill"></i>
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $wishlists->links() }}
    </div>

    @else

    {{-- Empty State --}}
    <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
        <i class="bi bi-heart fs-1 text-danger mb-3"></i>
        <h5 class="fw-bold mb-3">Wishlist Kamu Masih Kosong</h5>
        <p class="text-muted mb-4">
            Tambahkan produk favorit kamu ke wishlist agar lebih mudah ditemukan nanti.
        </p>
        <a href="{{ route('shop.index') }}"
            class="btn text-white rounded-3"
            style="background-color:#b45309;">
            Jelajahi Produk
        </a>
    </div>

    @endif

</div>
@endsection


@push('styles')
<style>
.wishlist-card {
    transition: all 0.25s ease;
}

.wishlist-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

@media (max-width: 576px) {
    .wishlist-card .card-body {
        flex-direction: column;
        text-align: center;
    }

    .wishlist-card img {
        width: 100px;
        height: 120px;
    }
}
</style>
@endpush