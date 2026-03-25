@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row">

        @include('profile.layout.sidebar')

        <div class="col-lg-9 col-md-8">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header text-white rounded-top-4 d-flex align-items-center justify-content-between"
                    style="background: linear-gradient(135deg, var(--primary,#7f574c), var(--accent,#b45309));">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-bag-heart me-2"></i>Pesanan Saya
                    </h5>
                    <span class="badge" style="background:rgba(255,255,255,.2);font-size:.8rem;">
                        {{ $orders->count() }} pesanan
                    </span>
                </div>

                <div class="card-body p-4">

                    @if($orders->isEmpty())
                    <div class="text-center py-5">
                        <div class="mb-3" style="font-size:3.5rem;opacity:.3;">🛍️</div>
                        <h6 class="text-muted">Belum ada pesanan</h6>
                        <p class="text-muted small mb-4">Yuk, mulai belanja produk kami!</p>
                        <a href="{{ route('shop.index') }}" class="btn rounded-pill px-4 text-white"
                            style="background: var(--primary,#7f574c);">
                            <i class="bi bi-bag-plus me-1"></i> Mulai Belanja
                        </a>
                    </div>
                    @else

                    @php
                    $statusConfig = [
                    'pending' => ['label' => 'Menunggu Konfirmasi', 'bg' => '#fef3c7', 'color' => '#92400e', 'icon' => 'bi-hourglass-split'],
                    'waiting_verification' => ['label' => 'Menunggu Verifikasi', 'bg' => '#dbeafe', 'color' => '#1e40af', 'icon' => 'bi-clock'],
                    'paid' => ['label' => 'Disetujui', 'bg' => '#d1fae5', 'color' => '#065f46', 'icon' => 'bi-check-circle'],
                    'declined' => ['label' => 'Ditolak', 'bg' => '#fee2e2', 'color' => '#991b1b', 'icon' => 'bi-x-circle'],
                    'canceled' => ['label' => 'Dibatalkan', 'bg' => '#f3f4f6', 'color' => '#374151', 'icon' => 'bi-dash-circle'],
                    ];
                    @endphp

                    @foreach($orders as $order)
                    @php $sc = $statusConfig[$order->status] ?? ['label' => ucfirst($order->status), 'bg' => '#f3f4f6', 'color' => '#374151', 'icon' => 'bi-circle']; @endphp
                    <div class="card border-0 mb-3 rounded-4 overflow-hidden"
                        style="border: 1px solid var(--border,#eadfd7) !important;">

                        {{-- Card top bar --}}
                        <div class="d-flex align-items-center justify-content-between px-4 py-2"
                            style="background: var(--surface-soft,#f7efe8); border-bottom: 1px solid var(--border,#eadfd7);">
                            <span class="small fw-semibold" style="color:var(--text-soft,#6b7280);">
                                <i class="bi bi-receipt me-1"></i>
                                Order #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                            </span>
                            <span class="small" style="color:var(--text-soft,#6b7280);">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>

                        <div class="card-body px-4 py-3">
                            <div class="row align-items-center gy-3">

                                {{-- Order items summary --}}
                                <div class="col-sm-7">
                                    @foreach($order->items->take(2) as $item)
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <i class="bi bi-box2 small" style="color:var(--accent,#b45309);"></i>
                                        <span class="small">
                                            {{ $item->product->name ?? 'Produk dihapus' }}
                                            <span class="text-muted">× {{ $item->quantity }}</span>
                                        </span>
                                    </div>
                                    @endforeach
                                    @if($order->items->count() > 2)
                                    <div class="small text-muted">+ {{ $order->items->count() - 2 }} produk lainnya</div>
                                    @endif

                                    <div class="mt-2 d-flex align-items-center gap-3">
                                        <span class="fw-bold" style="color:var(--primary,#7f574c);">
                                            Rp {{ number_format($order->total, 0, ',', '.') }}
                                        </span>
                                        <span class="small text-muted">
                                            {{ $order->payment_method === 'transfer' ? '💳 Transfer' : '🏪 Di Toko' }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Status + Actions --}}
                                <div class="col-sm-5 d-flex flex-column align-items-sm-end gap-2">
                                    <span class="badge rounded-pill px-3 py-2"
                                        style="background:{{ $sc['bg'] }};color:{{ $sc['color'] }};font-size:.78rem;">
                                        <i class="bi {{ $sc['icon'] }} me-1"></i>{{ $sc['label'] }}
                                    </span>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('checkout.success', $order->id) }}"
                                            class="btn btn-sm rounded-pill px-3"
                                            style="border:1.5px solid var(--primary,#7f574c);color:var(--primary,#7f574c);">
                                            <i class="bi bi-eye me-1"></i>Detail
                                        </a>
                                        <a href="{{ route('checkout.invoice', $order->id) }}"
                                            class="btn btn-sm rounded-pill px-3"
                                            style="border:1.5px solid var(--border,#eadfd7);color:var(--text-soft,#6b7280);">
                                            <i class="bi bi-file-earmark-pdf me-1"></i>PDF
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach

                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
@endsection