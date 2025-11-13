@include('layouts.partials.navbar')

@extends('layouts.main')

@section('content')
<div class="container my-4">
    <h3 class="fw-bold mb-4">Wishlist</h3>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('info'))
    <div class="alert alert-info">{{ session('info') }}</div>
    @endif

    @if($wishlists->count() > 0)
    <div class="wishlist-list">
        @foreach($wishlists as $wishlist)
        <div class="wishlist-item d-flex align-items-center mb-4 pb-3">
            <!-- Ikon Hati -->
            <div class="me-3 text-center" style="width: 40px;">
                <form action="{{ route('wishlist.remove', $wishlist->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link p-0 text-danger fs-4" title="Hapus dari wishlist">
                        <i class="fas fa-heart"></i>
                    </button>
                </form>
            </div>

            <!-- Gambar Produk -->
            <div class="me-3">
                <img src="{{ asset('storage/' . $wishlist->product->image) }}"
                    alt="{{ $wishlist->product->name }}"
                    class="rounded"
                    style="width: 100px; height: 120px; object-fit: cover;">
            </div>

            <!-- Detail Produk -->
            <div>
                <h5 class="mb-1">{{ $wishlist->product->name }}</h5>
                <p class="fw-bold text-dark mb-1">
                    Rp {{ number_format($wishlist->product->price, 0, ',', '.') }}
                </p>
                <!-- <small class="text-muted">
                    <i class="fas fa-star text-warning"></i> 0 &middot; Terjual 0
                </small> -->
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $wishlists->links() }}
    </div>
    @else
    <div class="alert alert-warning">Kamu belum menambahkan produk ke wishlist.</div>
    @endif
</div>
@endsection

@push('styles')
<style>
    .wishlist-item {
        flex-wrap: wrap;
    }

    @media (max-width: 576px) {
        .wishlist-item img {
            width: 80px;
            height: 100px;
        }
    }
</style>
@endpush