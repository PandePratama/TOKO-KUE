@include('layouts.partials.navbar')

@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Sidebar -->
        @include('profile.layout.sidebar')

        <!-- Daftar Pesanan -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-bag"></i> Daftar Pesanan Saya</h5>
                </div>
                <div class="card-body">
                    @if($orders->isEmpty())
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-box-seam" style="font-size: 3rem;"></i>
                        <p class="mt-3">Belum ada pesanan.</p>
                    </div>
                    @else
                    @foreach($orders as $order)
                    <div class="border rounded-3 p-3 mb-3 bg-light shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1"><strong>ID Pesanan:</strong> #{{ $order->id }}</p>
                                <p class="mb-1"><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}</p>
                                <p class="mb-1"><strong>Total:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                                <p class="mb-1">
                                    <strong>Status:</strong>
                                    <span class="badge 
                                                @if($order->status === 'pending') bg-warning text-dark
                                                @elseif($order->status === 'waiting_verification') bg-info
                                                @elseif($order->status === 'completed') bg-success
                                                @elseif($order->status === 'canceled') bg-danger
                                                @else bg-secondary
                                                @endif">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('checkout.success', $order->id) }}" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-eye"></i> Detail
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