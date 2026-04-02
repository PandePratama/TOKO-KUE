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
                        <div class="alert alert-warning mt-3 mb-3">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            Bukti transfer belum diunggah.
                        </div>
                        <form action="{{ route('checkout.upload', $order->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-2">
                                <label for="payment_proof_upload" class="form-label fw-semibold small">
                                    <i class="bi bi-upload me-1"></i> Upload Bukti Transfer
                                </label>
                                <input type="file" name="payment_proof" id="payment_proof_upload"
                                    class="form-control form-control-sm @error('payment_proof') is-invalid @enderror"
                                    accept="image/jpeg,image/png,application/pdf">
                                <div class="form-text text-muted">Format: JPG, PNG, PDF &bull; Maks. 5 MB</div>
                                @error('payment_proof')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-sm btn-warning rounded-pill px-3">
                                <i class="bi bi-cloud-upload me-1"></i> Upload Sekarang
                            </button>
                        </form>
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
                    <div class="mt-4 d-flex flex-wrap gap-2 justify-content-center">
                        <a href="{{ url('/') }}" class="btn btn-outline-success rounded-pill px-4">
                            <i class="bi bi-house-door me-2"></i> Kembali ke Beranda
                        </a>
                        <a href="{{ route('checkout.invoice', $order->id) }}" class="btn rounded-pill px-4"
                            style="background:#7f574c;color:#fff;">
                            <i class="bi bi-file-earmark-pdf me-2"></i> Download Invoice PDF
                        </a>
                    </div>

                </div>
            </div>

            <!-- Status Timeline -->
            @if($order->statusHistories->isNotEmpty())
            <div class="card border-0 shadow-sm rounded-4 mt-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="bi bi-clock-history me-2 text-brand"></i> Riwayat Status Pesanan
                    </h5>
                    <div class="status-timeline">
                        @foreach($order->statusHistories as $history)
                        <div class="timeline-item d-flex gap-3">
                            <div class="timeline-dot-wrap d-flex flex-column align-items-center">
                                <div class="timeline-dot bg-brand"></div>
                                @if(!$loop->last)<div class="timeline-connector"></div>@endif
                            </div>
                            <div class="pb-4">
                                <span class="badge status-badge-{{ $history->status }} mb-1">
                                    @php
                                    $statusLabels = [
                                    'pending' => 'Menunggu Konfirmasi',
                                    'waiting_verification' => 'Menunggu Verifikasi',
                                    'paid' => 'Dibayar / Disetujui',
                                    'declined' => 'Ditolak',
                                    'canceled' => 'Dibatalkan',
                                    ];
                                    @endphp
                                    {{ $statusLabels[$history->status] ?? ucfirst($history->status) }}
                                </span>
                                @if($history->note)
                                <p class="text-muted small mb-1">{{ $history->note }}</p>
                                @endif
                                <small class="text-muted">
                                    <i class="bi bi-calendar2 me-1"></i>
                                    {{ \Carbon\Carbon::parse($history->created_at)->format('d M Y, H:i') }}
                                </small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

@push('styles')
<style>
    .text-brand {
        color: var(--primary, #7f574c);
    }

    .bg-brand {
        background-color: var(--primary, #7f574c);
    }

    /* Timeline */
    .timeline-dot-wrap {
        min-width: 18px;
    }

    .timeline-dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        flex-shrink: 0;
        margin-top: 3px;
    }

    .timeline-connector {
        width: 2px;
        flex: 1;
        background: #eadfd7;
        min-height: 20px;
    }

    /* Status badges */
    .status-badge-pending {
        background: #fef3c7;
        color: #92400e;
        font-size: .78rem;
        padding: .3rem .65rem;
        border-radius: 999px;
    }

    .status-badge-waiting_verification {
        background: #dbeafe;
        color: #1e40af;
        font-size: .78rem;
        padding: .3rem .65rem;
        border-radius: 999px;
    }

    .status-badge-paid {
        background: #d1fae5;
        color: #065f46;
        font-size: .78rem;
        padding: .3rem .65rem;
        border-radius: 999px;
    }

    .status-badge-declined {
        background: #fee2e2;
        color: #991b1b;
        font-size: .78rem;
        padding: .3rem .65rem;
        border-radius: 999px;
    }

    .status-badge-canceled {
        background: #f3f4f6;
        color: #374151;
        font-size: .78rem;
        padding: .3rem .65rem;
        border-radius: 999px;
    }
</style>
@endpush
@endsection