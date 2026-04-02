@extends('admin.layouts.admin')

@section('content')
<div class="container">
    <h3>Detail Pesanan #{{ $order->id }}</h3>
    <p><strong>User:</strong> {{ $order->user->name }}</p>
    <p><strong>Total:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
    <p><strong>Metode Pembayaran:</strong> {{ ucfirst($order->payment_method) }}</p>
    <p><strong>Status:</strong> {{ $order->status }}</p>

    <h5>Daftar Produk</h5>
    <ul>
        @foreach($order->items as $item)
        <li>{{ $item->product->name }} - {{ $item->quantity }} pcs</li>
        @endforeach
    </ul>

    @if($order->payment_proof)
    <p><strong>Bukti Transfer:</strong></p>
    <img src="{{ asset('storage/'.$order->payment_proof) }}" class="img-fluid mb-3" style="max-width:300px;">
    @endif

    <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-success">Approve</button>
    </form>

    <form action="{{ route('admin.orders.decline', $order->id) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-danger">Decline</button>
    </form>
</div>
@endsection