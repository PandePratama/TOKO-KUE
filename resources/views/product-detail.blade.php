@extends('layouts.main')

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
            <h2 class="fw-bold">{{ $product->name }}</h2>

            {{-- Harga --}}
            <div class="">
                <span class="fs-4 text-danger fw-bold">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
            </div>

            {{-- Stok --}}
            <div class="">
                <span class="text-muted">
                    Stok: {{ $product->stock_quantity }}
                </span>
            </div>

            {{-- Deskripsi --}}
            <p class="text-muted">
                {{ $product->description ?: 'Tidak ada deskripsi untuk produk ini.' }}
            </p>

            {{-- Form Tambah ke Keranjang --}}
            <form action="{{ route('cart.store') }}" method="POST" class="d-flex align-items-center gap-3 mb-4">
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
                    class="btn fw-bold text-white"
                    style="background-color:#b45309;">
                    <i class="bi bi-cart"></i> ADD TO CART
                </button>

                {{-- Wishlist --}}
                <button type="button" class="btn btn-outline-secondary">
                    <i class="bi bi-heart"></i>
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Script tambah / kurang jumlah --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const decrease = document.getElementById("decrease");
        const increase = document.getElementById("increase");
        const qtyInput = document.querySelector("input[name='quantity']");
        const MIN_QTY = 20;

        // Pastikan tidak bisa kurang dari 20 saat manual input
        qtyInput.addEventListener("input", function() {
            if (parseInt(this.value) < MIN_QTY || isNaN(this.value)) {
                this.value = MIN_QTY;
            }
        });

        decrease.addEventListener("click", function() {
            let value = parseInt(qtyInput.value) || MIN_QTY;
            if (value > MIN_QTY) {
                qtyInput.value = value - 1;
            }
        });

        increase.addEventListener("click", function() {
            let value = parseInt(qtyInput.value) || MIN_QTY;
            qtyInput.value = value + 1;
        });

    });
</script>
@endsection