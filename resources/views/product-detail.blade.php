@extends('layouts.main')
@include('layouts.partials.navbar')

@section('title', $product->name)

@section('content')
<div class="container py-5">
    <div class="row g-5 align-items-start">

        {{-- Gambar Produk --}}
        <div class="col-md-6">
            <div
                class="border bg-light d-flex align-items-center justify-content-center rounded shadow-sm"
                style="height: 500px; overflow: hidden;">
                <img
                    src="{{ asset('storage/' . $product->primaryImage->image_path) }}"
                    alt="{{ $product->name }}"
                    class="img-fluid"
                    style="max-height: 480px; max-width: 100%; object-fit: contain;">
            </div>
        </div>

        {{-- Detail Produk --}}
        <div class="col-md-6">
            <h2 class="fw-bold mb-3">{{ $product->name }}</h2>

            {{-- Harga --}}
            <div class="mb-3">
                <span class="fs-4 text-danger fw-bold">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
            </div>

            {{-- Deskripsi --}}
            <p class="text-muted mb-4">
                {{ $product->description ?: 'Tidak ada deskripsi untuk produk ini.' }}
            </p>

            {{-- Form Tambah ke Keranjang --}}
            <form action="{{ route('cart.store') }}" method="POST" class="d-flex align-items-center gap-3 mb-4">
                @csrf

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="input-group" style="max-width: 140px;">
                    <button type="button" class="btn btn-outline-secondary" id="decrease">−</button>
                    <input
                        type="number"
                        name="quantity"
                        value="1"
                        min="1"
                        class="form-control text-center">
                    <button type="button" class="btn btn-outline-secondary" id="increase">+</button>
                </div>

                <button type="submit" class="btn fw-bold text-white" style="background-color:#b45309;">
                    <i class="bi bi-cart"></i> ADD TO CART
                </button>

                <button type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-heart"></i>
                </button>
            </form>

            {{-- Whatsapp --}}
            <div>
                <strong>Whatsapp:</strong>
                <a
                    href="https://wa.me/628980592309"
                    target="_blank"
                    class="text-success text-decoration-none">
                    +62 898-0592-309
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Script tambah / kurang jumlah --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const decrease = document.getElementById("decrease");
        const increase = document.getElementById("increase");
        const qtyInput = document.querySelector("input[name='quantity']");

        decrease.addEventListener("click", () => {
            const val = parseInt(qtyInput.value) || 1;
            if (val > 1) qtyInput.value = val - 1;
        });

        increase.addEventListener("click", () => {
            const val = parseInt(qtyInput.value) || 1;
            qtyInput.value = val + 1;
        });
    });
</script>
@endsection