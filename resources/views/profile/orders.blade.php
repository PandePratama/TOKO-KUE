@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row">

        @include('profile.layout.sidebar')

        <div class="col-lg-9 col-md-8">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-success text-white rounded-top-4">
                    <h5 class="mb-0">
                        <i class="bi bi-bag me-2"></i>Daftar Pesanan Saya
                    </h5>
                </div>

                <div class="card-body p-4">

                    @if($orders->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-box-seam fs-1"></i>
                            <p class="mt-3">Belum ada pesanan.</p>
                        </div>
                    @else

                        @foreach($orders as $order)
                        <div class="card border-0 shadow-sm mb-3 rounded-4">
                            <div class="card-body d-flex justify-content-between align-items-center">

                                <div>
                                    <h6 class="fw-bold mb-2">
                                        Pesanan #{{ $order->id }}
                                    </h6>

                                    <div class="text-muted small">
                                        {{ $order->created_at->format('d M Y') }}
                                    </div>

                                    <div class="fw-semibold mt-2">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </div>

                                    <span class="badge mt-2
                                        @if($order->status === 'pending') bg-warning text-dark
                                        @elseif($order->status === 'waiting_verification') bg-info
                                        @elseif($order->status === 'completed') bg-success
                                        @elseif($order->status === 'canceled') bg-danger
                                        @else bg-secondary
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </div>

                                <div>
                                    <a href="{{ route('checkout.success', $order->id) }}"
                                        class="btn btn-outline-success rounded-3">
                                        <i class="bi bi-eye me-1"></i> Detail
                                    </a>
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