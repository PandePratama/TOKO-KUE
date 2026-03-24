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
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="shipping-item text-center">
                        <div class="shipping-img mx-auto mb-3">
                            <img src="{{ asset('images/customer-service.svg') }}" alt="Online Support">
                        </div>
                        <div class="shipping-content">
                            <h5 class="title fw-bold">Online Support</h5>
                            <p class="short-desc mb-0">24/7 Online Support Provide</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="shipping-item text-center">
                        <div class="shipping-img mx-auto mb-3">
                            <img src="{{ asset('images/credit-card.svg') }}" alt="Secure Payment">
                        </div>
                        <div class="shipping-content">
                            <h5 class="title fw-bold">Secure Payment</h5>
                            <p class="short-desc mb-0">Fully Secure Payment System</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shipping Area End Here -->

    <!-- Products Grid -->
    <section id="products" class="py-5">
        <div class="container">
            <h2 class="mb-5 text-center" style="color:#b45309;">Produk Kami</h2>

            <div class="row justify-content-center">
                @forelse ($products as $product)
                <div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="product-card text-center">
                        <div class="product-img position-relative">
                            @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                            <img src="https://via.placeholder.com/400x400?text=No+Image" alt="No Image">
                            @endif

                            <!-- Hover Action Buttons -->
                            <div class="product-actions d-flex gap-2">
                                <!-- Tambah ke Cart -->
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="20">
                                    <button type="submit" class="action-btn"><i class="bi bi-cart"></i></button>
                                </form>

                                <!-- Tambah ke Wishlist -->
                                <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="action-btn"><i class="bi bi-heart"></i></button>
                                </form>
                            </div>
                        </div>

                        <div class="product-info">
                            <h5 class="product-name">{{ $product->name }}</h5>
                            <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <a href="{{ route('product.detail', $product->id) }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center">Belum ada produk.</p>
                @endforelse
            </div>

            <!-- Tombol "Lihat Produk Lainnya" -->
            <div class="text-center mt-4">
                <a href="{{ route('shop.index') }}" class="btn btn-outline-success rounded-pill px-4 py-2 fw-semibold">
                    Lihat Produk Lainnya <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </section>


    <!-- Footer -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>