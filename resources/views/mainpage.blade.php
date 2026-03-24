@extends('layouts.main')

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center justify-content-center text-center">
        <div class="overlay"></div>
        <div class="container position-relative">
            <h1 class="display-4 fw-bold">Jajanan Tradisional Kaliadrem</h1>
            <p class="lead mb-4">Rasakan keautentikan rasa jajanan tradisional Bali</p>
            <a href="#products" class="btn btn-light btn-lg fw-semibold">Belanja Sekarang</a>
        </div>
    </section>

    <!-- Begin Shipping Area -->
    <div class="shipping-area section-space-top-100 py-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="shipping-item text-center">
                        <div class="shipping-img mx-auto mb-3">
                            <img src="{{ asset('images/free-shipping.svg') }}" alt="Free Shipping">
                        </div>
                        <div class="shipping-content">
                            <h5 class="title fw-bold">Free Shipping</h5>
                            <p class="short-desc mb-0">Free Home Delivery Offer</p>
                        </div>
                    </div>

                    {{-- Online Support --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="shipping-item text-center">
                            <div class="shipping-img mx-auto mb-3">
                                <img src="{{ asset('images/customer-service.svg') }}" alt="Online Support">
                            </div>
                            <h5 class="fw-bold">Online Support</h5>
                            <p class="mb-0">24/7 Online Support Provide</p>
                        </div>
                    </div>

                    {{-- Secure Payment --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="shipping-item text-center">
                            <div class="shipping-img mx-auto mb-3">
                                <img src="{{ asset('images/credit-card.svg') }}" alt="Secure Payment">
                            </div>
                            <h5 class="fw-bold">Secure Payment</h5>
                            <p class="mb-0">Fully Secure Payment System</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        {{-- ================= PRODUCT SECTION ================= --}}
        <section id="products" class="py-5">
            <div class="container">

                <h2 class="text-center mb-5" style="color:#b45309;">
                    Produk Kami
                </h2>

                <div class="row justify-content-center">

                    @forelse ($products as $product)
                        <div class="col-6 col-md-4 col-lg-3 mb-4">
                            <div class="product-card text-center">

                                {{-- Product Image --}}
                                <div class="product-img position-relative">

                                    @if ($product->primaryImage)
                                        <img 
                                            src="{{ Storage::url($product->primaryImage->image_path) }}" 
                                            alt="{{ $product->name }}"
                                        >
                                    @else
                                        <img 
                                            src="https://via.placeholder.com/400x400?text=No+Image" 
                                            alt="No Image"
                                        >
                                    @endif

                                    {{-- Hover Actions --}}
                                    <div class="product-actions d-flex gap-2">

                                        {{-- Add to Cart --}}
                                        <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">

                                            <button type="submit" class="action-btn">
                                                <i class="bi bi-cart"></i>
                                            </button>
                                        </form>

                                        {{-- Add to Wishlist --}}
                                        <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="action-btn">
                                                <i class="bi bi-heart"></i>
                                            </button>
                                        </form>

                                    </div>
                                </div>

                                {{-- Product Info --}}
                                <div class="product-info">
                                    <h5 class="product-name">
                                        {{ $product->name }}
                                    </h5>

                                    <p class="product-price">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>

                                    <a href="{{ route('product.detail', $product->id) }}" class="stretched-link"></a>
                                </div>

                            </div>
                        </div>

                    @empty
                        <div class="col-12">
                            <p class="text-center">Belum ada produk.</p>
                        </div>
                    @endforelse


    <!-- Footer -->


            </div>
        </section>

    @endsection