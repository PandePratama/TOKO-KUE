@extends('layouts.main')

@section('title', 'Keranjang Belanja - JajanSnack')

@section('content')
<div class="container py-5">

    <div class="row g-5">

        <!-- LEFT SIDE - CART ITEMS -->
        <div class="col-lg-8">

            <h3 class="fw-bold mb-4">Keranjang Belanja</h3>

            @if ($carts->isEmpty())

            <!-- Empty State -->
            <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                <i class="bi bi-cart fs-1 mb-3 text-secondary"></i>
                <h5 class="fw-bold">Keranjang Kamu Masih Kosong</h5>
                <p class="text-muted mb-4">
                    Yuk tambahkan produk favorit kamu ke keranjang.
                </p>
                <a href="{{ route('shop.index') }}"
                    class="btn text-white rounded-3 px-4"
                    style="background-color:#b45309;">
                    Belanja Sekarang
                </a>
            </div>

            @else

            @foreach ($carts as $cart)
            <div class="card border-0 shadow-sm rounded-4 mb-4 cart-card">

                <div class="card-body d-flex align-items-center flex-wrap">

                    <!-- Product Image -->
                    <div class="me-4">
                        @if($cart->product && $cart->product->primaryImage)
                        <img src="{{ Storage::url($cart->product->primaryImage->image_path) }}"
                            class="rounded-3"
                            style="width:120px;height:120px;object-fit:cover;">
                        @else
                        <img src="https://via.placeholder.com/120"
                            class="rounded-3">
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="flex-grow-1">
                        <h5 class="fw-semibold mb-2">
                            {{ $cart->product->name }}
                        </h5>

                        <div class="text-danger fw-bold fs-5">
                            Rp {{ number_format($cart->product->price, 0, ',', '.') }}
                        </div>
                    </div>

                    <!-- Quantity Control -->
                    <div class="d-flex align-items-center mt-3 mt-lg-0">

                        <form action="{{ route('cart.update', $cart->id) }}"
                            method="POST"
                            class="d-flex align-items-center">
                            @csrf
                            @method('PATCH')

                            <div class="input-group quantity-group">

                                <button type="submit"
                                    name="action"
                                    value="decrease"
                                    class="btn btn-outline-secondary"
                                    {{ $cart->quantity <= 20 ? 'disabled' : '' }}>
                                    −
                                </button>

                                <input type="number"
                                    name="quantity"
                                    value="{{ $cart->quantity }}"
                                    min="20"
                                    class="form-control text-center"
                                    onchange="this.form.submit()">

                                <button type="submit"
                                    name="action"
                                    value="increase"
                                    class="btn btn-outline-secondary">
                                    +
                                </button>

                            </div>
                        </form>

                        <!-- Remove Button -->
                        <form action="{{ route('cart.remove', $cart->id) }}"
                            method="POST"
                            class="ms-3">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm rounded-3">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>

                    </div>

                </div>

            </div>
            @endforeach

            @endif

        </div>

        <!-- RIGHT SIDE - SUMMARY -->
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top"
                style="top: 100px;">

                <h5 class="fw-bold mb-4">Ringkasan Belanja</h5>

                @php
                $subtotal = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);
                @endphp

                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal</span>
                    <span>
                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                    </span>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span>Total Item</span>
                    <span>{{ $carts->sum('quantity') }}</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between mb-4">
                    <span class="fw-bold">Total</span>
                    <span class="fw-bold text-dark fs-5">
                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                    </span>
                </div>

                <a href="{{ route('checkout.index') }}"
                    class="btn w-100 text-white rounded-3 py-2"
                    style="background-color:#b45309;">
                    Lanjut ke Checkout
                </a>

            </div>

        </div>

    </div>

</div>
@endsection


@push('styles')
<style>
    .cart-card {
        transition: all 0.25s ease;
    }

    .cart-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
    }

    .quantity-group input {
        max-width: 70px;
    }

    @media (max-width: 768px) {
        .cart-card .card-body {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endpush