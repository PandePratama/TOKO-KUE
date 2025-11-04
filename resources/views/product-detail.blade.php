@extends('layouts.main')
@include('layouts.partials.navbar')

@section('title', $product->name)

@section('content')
<div class="container py-5">
    <div class="row g-5 align-items-start">

        {{-- Gambar Produk --}}
        <div class="col-md-6">
            <div class="border bg-light d-flex align-items-center justify-content-center rounded shadow-sm" style="height: 500px;">
                @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="img-fluid"
                    style="max-height: 480px; object-fit: contain;">
                @else
                <img src="https://via.placeholder.com/600x400?text=No+Image"
                    alt="No Image"
                    class="img-fluid">
                @endif
            </div>
        </div>

        {{-- Detail Produk --}}
        <div class="col-md-6">
            <h2 class="fw-bold">{{ $product->name }}</h2>

            {{-- Harga --}}
            <div class="mb-2">
                <span class="fs-4 text-danger fw-bold">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
            </div>

            {{-- Deskripsi --}}
            <p class="text-muted mb-4">
                {{ $product->description ?? 'Tidak ada deskripsi untuk produk ini.' }}
            </p>

            {{-- Form Tambah ke Keranjang --}}
            <form action="{{ route('cart.store') }}" method="POST" class="d-flex align-items-center gap-3 mb-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="input-group" style="max-width: 160px;">
                    <button type="button" class="btn btn-outline-secondary" id="decrease">−</button>
                    <input type="number" name="quantity" value="20" min="1" class="form-control text-center">
                    <button type="button" class="btn btn-outline-secondary" id="increase">+</button>
                </div>
                <button type="submit" class="btn fw-bold text-white" style="background-color:#b45309;">
                    <i class="bi bi-cart"></i> ADD TO CART
                </button>
                <button type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-heart"></i>
                </button>
            </form>

            <div class="mb-3">
                <strong>Whatsapp:</strong>
                <a href="https://wa.me/628980592309" target="_blank" class="text-success">
                    +628980592309
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Script tambah kurang jumlah --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const decrease = document.getElementById("decrease");
        const increase = document.getElementById("increase");
        const qtyInput = document.querySelector("input[name='quantity']");

        decrease.addEventListener("click", () => {
            let val = parseInt(qtyInput.value);
            if (val > 1) qtyInput.value = val - 1;
        });
        increase.addEventListener("click", () => {
            let val = parseInt(qtyInput.value);
            qtyInput.value = val + 1;
        });
    });
</script>
@endsection