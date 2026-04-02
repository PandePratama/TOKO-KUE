@extends('admin.layouts.admin')

@section('title', 'Tanggal Libur Pengiriman')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Pengaturan Tanggal Libur Pengiriman</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pickup-dates.store') }}" class="form-inline mb-3">
                @csrf
                <label for="pickup_date" class="mr-2">Tanggal Libur:</label>
                <input type="date" name="pickup_date" id="pickup_date" class="form-control mr-2"
                    required min="{{ now()->addDays(3)->toDateString() }}">
                <input type="text" name="note" placeholder="Catatan (opsional)" class="form-control mr-2">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>

            @error('pickup_date')
            <div class="text-danger mb-2">{{ $message }}</div>
            @enderror

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Tanggal Libur</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($holidays as $holiday)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($holiday->pickup_date)->format('d M Y') }}</td>
                            <td>{{ $holiday->note ?? '-' }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.pickup-dates.destroy', $holiday->id) }}"
                                    onsubmit="return confirm('Hapus tanggal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada tanggal libur.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection