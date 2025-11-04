@include('layouts.partials.navbar')

@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">

                    <h2 class="fw-bold text-center mb-4 text-success">
                        <i class="bi bi-bag-check me-2"></i> Checkout
                    </h2>

                    <!-- Ringkasan Belanja -->
                    <h5 class="fw-semibold mb-3 text-dark">🛒 Ringkasan Belanja</h5>
                    <div class="border rounded-3 p-3 bg-light mb-4">
                        @foreach($cartItems as $item)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-secondary">{{ $item->product->name }} x {{ $item->quantity }}</span>
                            <span class="fw-semibold text-dark">
                                Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                            </span>
                        </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold fs-5 text-dark">Total</span>
                            <span class="fw-bold fs-5 text-success">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>


                    <!-- Form Pembayaran -->
                    <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Pilih Tanggal Pengambilan -->
                        <h5 class="fw-semibold mb-3 text-dark">📅 Pilih Tanggal Pengambilan</h5>
                        <div class="border rounded-3 p-3 bg-light mb-4">
                            <input type="text" id="pickup_date" name="pickup_date" class="form-control"
                                placeholder="Pilih tanggal pengambilan..." required>
                            @error('pickup_date')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <h5 class="fw-semibold mb-3 text-dark">💳 Metode Pembayaran</h5>

                        <!-- Transfer Bank -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="transfer" value="transfer" checked>
                            <label class="form-check-label fw-semibold" for="transfer">
                                Transfer Bank (upload bukti transfer)
                            </label>
                        </div>

                        <div id="bankDetails" class="border rounded-3 p-3 bg-light mb-3">
                            <h6 class="fw-bold text-dark mb-2">Informasi Rekening Bank:</h6>
                            <ul class="list-unstyled mb-2">
                                <li><strong>🏦 Bank:</strong> BCA</li>
                                <li><strong>💳 No. Rekening:</strong> 1234567890</li>
                                <li><strong>👤 Atas Nama:</strong> Jajan Snack Indonesia</li>
                            </ul>
                            <small class="text-muted">Silakan lakukan transfer ke rekening di atas dan unggah bukti transfer di bawah ini.</small>
                        </div>

                        <div id="transferUpload" class="mb-4">
                            <label for="payment_proof" class="form-label text-muted">Upload Bukti Transfer</label>
                            <input type="file" name="payment_proof" id="payment_proof" class="form-control" accept="image/*">
                        </div>

                        <!-- Bayar di Toko -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="payment_method" id="store" value="store">
                            <label class="form-check-label fw-semibold" for="store">
                                Bayar di Toko
                            </label>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-5 py-2 rounded-pill shadow-sm">
                                <i class="bi bi-bag-check-fill me-2"></i> Buat Pesanan
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Flatpickr CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Script Kalender -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const holidays = @json($holidays);
        const minDate = new Date();
        minDate.setDate(minDate.getDate() + 3); // minimal H-3

        flatpickr("#pickup_date", {
            dateFormat: "Y-m-d",
            minDate: minDate,
            disable: holidays,
            locale: "id",
            altInput: true,
            altFormat: "l, d F Y",
        });

        // Sembunyikan upload jika bukan transfer
        const transferRadio = document.getElementById('transfer');
        const storeRadio = document.getElementById('store');
        const uploadBox = document.getElementById('transferUpload');
        const bankBox = document.getElementById('bankDetails');

        function toggleUpload() {
            const isTransfer = transferRadio.checked;
            uploadBox.style.display = isTransfer ? 'block' : 'none';
            bankBox.style.display = isTransfer ? 'block' : 'none';
        }

        transferRadio.addEventListener('change', toggleUpload);
        storeRadio.addEventListener('change', toggleUpload);
        toggleUpload();
    });
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection