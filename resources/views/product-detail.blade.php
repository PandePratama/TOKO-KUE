@extends('layouts.main')

@section('title', $product->name . ' - JajanSnack')

@push('meta')
<meta name="description" content="{{ Str::limit($product->description, 155) }}">
@endpush

@section('content')
<div class="container py-5">
    <div class="row g-5 align-items-start">

        {{-- Gambar Produk --}}
        <div class="col-md-6">
            <div
                class="border bg-light d-flex align-items-center justify-content-center rounded shadow-sm"
                style="height: 500px; overflow: hidden;">
                @if($product->primaryImage)
                <img
                    src="{{ asset('storage/' . $product->primaryImage->image_path) }}"
                    alt="{{ $product->name }}"
                    class="img-fluid"
                    style="max-height: 480px; max-width: 100%; object-fit: contain;">
                @else
                <span class="text-muted"><i class="bi bi-image" style="font-size:4rem;"></i></span>
                @endif
            </div>
        </div>

        {{-- Detail Produk --}}
        <div class="col-md-6">
            <h1 class="fw-bold fs-3">{{ $product->name }}</h1>

            {{-- Harga --}}
            <div class="mb-2">
                <span class="fs-4 fw-bold" style="color:var(--accent,#b45309);">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
            </div>

            {{-- Stok --}}
            <div class="mb-3">
                @if($product->stock_quantity > 0)
                <span class="badge bg-success">Stok tersedia ({{ $product->stock_quantity }})</span>
                @else
                <span class="badge bg-danger">Stok Habis</span>
                @endif
            </div>

            {{-- Deskripsi --}}
            <p class="text-muted">
                {{ $product->description ?: 'Tidak ada deskripsi untuk produk ini.' }}
            </p>

            @if($product->stock_quantity > 0)
            {{-- Form Tambah ke Keranjang --}}
            <form action="{{ route('cart.store') }}" method="POST" class="d-flex align-items-center flex-wrap gap-3 mb-3">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                {{-- Quantity (Minimal 20) --}}
                <div class="input-group" style="max-width: 160px;">
                    <button type="button" class="btn btn-outline-secondary" id="decrease">−</button>
                    <input
                        type="number"
                        name="quantity"
                        value="20"
                        min="20"
                        step="1"
                        class="form-control text-center fw-bold"
                        required>
                    <button type="button" class="btn btn-outline-secondary" id="increase">+</button>
                </div>

                {{-- Add to Cart --}}
                <button type="submit"
                    class="btn fw-bold text-white rounded-pill px-4"
                    style="background-color: var(--accent,#b45309);">
                    <i class="bi bi-cart me-1"></i> Tambah ke Keranjang
                </button>
            </form>
            @else
            <div class="alert alert-warning rounded-3">
                Produk ini sedang kehabisan stok.
            </div>
            @endif

            {{-- Wishlist (separate form) --}}
            <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="bi bi-heart me-1"></i> Simpan ke Wishlist
                </button>
            </form>
        </div>
    </div>

    {{-- ===== Produk Terkait ===== --}}
    @if($related->isNotEmpty())
    <hr class="my-5">
    <h4 class="fw-bold mb-4" style="color:var(--primary,#7f574c);">
        <i class="bi bi-grid me-2"></i>Produk Lainnya
    </h4>
    <div class="row g-4">
        @foreach($related as $r)
        <div class="col-6 col-md-3">
            <a href="{{ route('product.detail', $r->id) }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    @if($r->primaryImage)
                    <img src="{{ Storage::url($r->primaryImage->image_path) }}"
                        alt="{{ $r->name }}" class="card-img-top"
                        style="height:180px;object-fit:cover;" loading="lazy">
                    @else
                    <div class="bg-light d-flex align-items-center justify-content-center"
                        style="height:180px;"><i class="bi bi-image text-muted fs-2"></i></div>
                    @endif
                    <div class="card-body p-3">
                        <h6 class="fw-semibold text-dark mb-1">{{ $r->name }}</h6>
                        <span class="fw-bold" style="color:var(--accent,#b45309);">
                            Rp {{ number_format($r->price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const decrease = document.getElementById("decrease");
        const increase = document.getElementById("increase");
        const qtyInput = document.querySelector("input[name='quantity']");
        if (!qtyInput) return;
        const MIN_QTY = 20;

        qtyInput.addEventListener("input", function() {
            if (parseInt(this.value) < MIN_QTY || isNaN(parseInt(this.value))) {
                this.value = MIN_QTY;
            }
        });

        decrease.addEventListener("click", function() {
            let value = parseInt(qtyInput.value) || MIN_QTY;
            if (value > MIN_QTY) qtyInput.value = value - 1;
        });

        increase.addEventListener("click", function() {
            let value = parseInt(qtyInput.value) || MIN_QTY;
            qtyInput.value = value + 1;
        });
    });
</script>
@endpush
@endsection