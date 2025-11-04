@extends('layouts.admin')

@section('title', 'Data Customer')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Customer</h1>

    <form action="{{ route('admin.customers.index') }}" method="GET" class="d-flex">
        <input type="text" name="search" class="form-control me-2"
            placeholder="Cari nama atau email..."
            value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="bg-warning text-white">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telepon</th>
                    <th>Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($customers as $index => $customer)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone_number }}</td>
                    <td>{{ $customer->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data customer.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection