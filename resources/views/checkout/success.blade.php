@extends('layouts.main')

@section('title', 'Checkout Berhasil - JajanSnack')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- CARD -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body text-center p-5">

                    <!-- Icon Success -->
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                    </div>

                    <!-- Judul -->
                    <h2 class="fw-bold text-success mb-3">Checkout Berhasil!</h2>
                    <p class="text-muted mb-4">
                        Terima kasih telah berbelanja di <strong>JajanSnack</strong>.<br>
                        Berikut adalah detail pesanan Anda:
                    </p>

                    <!-- Order Info -->
                    <div class="text-start bg-light p-4 rounded-3 mb-4 shadow-sm">
                        <p class="mb-2"><strong>🆔 Order ID:</strong> {{ $order->id }}</p>
                        <p class="mb-2"><strong>💰 Total:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                        <p class="mb-2"><strong>💳 Metode Pembayaran:</strong>
                            {{ $order->payment_method == 'transfer' ? 'Transfer Bank' : 'Bayar di Toko' }}
                        </p>
                        <p class="mb-0"><strong>📦 Status Pesanan:</strong> {{ ucfirst($order->status) }}</p>
                    </div>

                    <!-- Jika Transfer Bank -->
                    @if($order->payment_method == 'transfer')
                    <div class="border rounded-3 p-4 bg-white text-start mb-4">
                        <h5 class="fw-semibold text-dark mb-3">💳 Transfer Bank</h5>
                        <p class="mb-2"><strong>🏦 Bank:</strong> BCA</p>
                        <p class="mb-2"><strong>💳 No. Rekening:</strong> 1234567890</p>
                        <p class="mb-3"><strong>👤 A/N:</strong> Jajan Snack Indonesia</p>

                        @if(!$order->payment_proof)
                        <div class="alert alert-warning mt-3 mb-0">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            Bukti transfer belum diunggah. Silakan unggah di halaman checkout saat melakukan pemesanan.
                        </div>
                        @else
                        <div class="mt-3">
                            <h6 class="fw-semibold text-dark">📸 Bukti Transfer:</h6>
                            <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Transfer"
                                class="img-fluid rounded shadow-sm mt-2" style="max-width: 350px;">
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Tombol kembali ke beranda -->
                    <div class="mt-4">
                        <a href="{{ url('/') }}" class="btn btn-outline-success rounded-pill px-4">
                            <i class="bi bi-house-door me-2"></i> Kembali ke Beranda
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection