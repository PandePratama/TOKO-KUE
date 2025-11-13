@include('layouts.partials.navbar')

@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Bagian Kiri - List Produk -->
        <div class="col-lg-8">
            <h3 class="mb-4 fw-bold">Keranjang Belanja</h3>

            @if ($carts->isEmpty())
            <p>Keranjang kamu masih kosong.</p>
            @else
            @foreach ($carts as $cart)
            <div class="card mb-3 shadow-sm border-0">
                <div class="row g-0 align-items-center">
                    <div class="col-md-2 text-center p-2">
                        @if($cart->product && $cart->product->image)
                        <img src="{{ asset('storage/' . $cart->product->image) }}" class="img-fluid rounded" alt="{{ $cart->product->name }}">
                        @else
                        <img src="https://via.placeholder.com/100" class="img-fluid rounded" alt="No Image">
                        @endif
                    </div>
                    <div class="col-md-5">
                        <div class="card-body">
                            <h5 class="card-title mb-1">{{ $cart->product->name }}</h5>
                            <p class="fw-bold text-dark mb-0">
                                Rp {{ number_format($cart->product->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex align-items-center justify-content-center">
                        <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            @method('PATCH')

                            <!-- Tombol Kurang -->
                            <button type="submit" name="action" value="decrease"
                                class="btn btn-sm btn-outline-dark me-2"
                                {{ $cart->quantity <= 1 ? 'disabled' : '' }}>-</button>

                            <!-- Input Quantity -->
                            <input type="number"
                                name="quantity"
                                value="{{ $cart->quantity }}"
                                min="1"
                                class="form-control text-center"
                                style="width: 70px;"
                                onchange="this.form.submit()">

                            <!-- Tombol Tambah -->
                            <button type="submit" name="action" value="increase"
                                class="btn btn-sm btn-outline-dark ms-2">+</button>
                        </form>
                    </div>

                    <div class="col-md-2 text-center">
                        <form action="{{ route('cart.remove', $cart->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm text-danger" title="Hapus">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>

        <!-- Bagian Kanan - Ringkasan Belanja -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 p-3 sticky-top" style="top: 80px;">
                <h5 class="fw-bold mb-3">Ringkasan Belanja</h5>
                @php
                $subtotal = $carts->sum(fn($cart) => $cart->product->price * $cart->quantity);
                @endphp
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal ({{ $carts->count() }})</span>
                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <span class="fw-bold">Total</span>
                    <span class="fw-bold text-dark">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('checkout.index') }}" class="btn btn-dark w-100 rounded-pill">Check Out</a>
            </div>
        </div>
    </div>
</div>

@endsection