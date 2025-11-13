@extends('layouts.main')
@include('layouts.partials.navbar')

@section('content')
<section id="products" class="py-5">
    <div class="container">
        <h2 class="mb-4 text-center" style="color:#b45309;">SHOP</h2>

        @if(request('q'))
        <p class="text-center mb-4">Hasil pencarian untuk: <strong>{{ request('q') }}</strong></p>
        @endif

        <div class="row justify-content-center">
            @forelse ($products as $product)
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="product-card text-center shadow-sm p-3 rounded position-relative">
                    <div class="product-img position-relative">
                        @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded">
                        @else
                        <img src="https://via.placeholder.com/400x400?text=No+Image" alt="No Image" class="img-fluid rounded">
                        @endif

                        <!-- Hover Action Buttons -->
                        <div class="product-actions d-flex gap-2 justify-content-center">
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

                    <div class="product-info mt-3">
                        <h5 class="product-name">{{ $product->name }}</h5>
                        <p class="product-price fw-bold text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="{{ route('product.detail', $product->id) }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center">Belum ada produk.</p>
            @endforelse

        </div>
    </div>
</section>
@endsection