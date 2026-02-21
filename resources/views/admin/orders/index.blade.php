@extends('admin.layouts.admin')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Pesanan</h1>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Total</th>
                            <th>Metode</th>
                            <th>Tanggal Transaksi</th>
                            <th>Tanggal Pengambilan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($order->payment_method) }}</td>
                            <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                            <td>
                                @if($order->pickup_date)
                                {{ \Carbon\Carbon::parse($order->pickup_date)->format('d-m-Y') }}
                                @else
                                <span class="text-muted">Belum dipilih</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge 
                                    @if($order->status=='paid') bg-success
                                    @elseif($order->status=='declined') bg-danger
                                    @elseif($order->status=='waiting_verification') bg-warning
                                    @else bg-light @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary">Detail</a>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada pesanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection