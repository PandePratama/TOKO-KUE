@extends('admin.layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <span class="text-muted small">Selamat datang, <strong>{{ Auth::user()->name }}</strong></span>
</div>

{{-- =========================================================
     ROW 1 — Stat Cards
     ========================================================= --}}
<div class="row">

    {{-- Total Users --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pelanggan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalUsers) }}</div>
                    </div>
                    <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Produk --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Produk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalProducts) }}</div>
                    </div>
                    <div class="col-auto"><i class="fas fa-box-open fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Order Bulan Ini --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Order Bulan Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($ordersThisMonth) }}</div>
                        <div class="text-xs text-muted">Menunggu proses: {{ $pendingOrders }}</div>
                    </div>
                    <div class="col-auto"><i class="fas fa-shopping-bag fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Revenue Bulan Ini --}}
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pendapatan Bulan Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($revenueThisMonth, 0, ',', '.') }}</div>
                        <div class="text-xs text-muted">Total: Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                    </div>
                    <div class="col-auto"><i class="fas fa-money-bill-wave fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- =========================================================
     ROW 2 — Charts
     ========================================================= --}}
<div class="row">

    {{-- Grafik Pendapatan --}}
    <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Pendapatan 6 Bulan Terakhir</h6>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="110"></canvas>
            </div>
        </div>
    </div>

    {{-- Grafik Jumlah Order --}}
    <div class="col-xl-4 col-lg-5 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-success">Jumlah Order 6 Bulan Terakhir</h6>
            </div>
            <div class="card-body">
                <canvas id="ordersChart" height="200"></canvas>
            </div>
        </div>
    </div>

</div>

{{-- =========================================================
     ROW 3 — Recent Orders
     ========================================================= --}}
<div class="row">
    <div class="col-12 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Order Terbaru</h6>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-list fa-sm mr-1"></i> Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td class="font-weight-bold">{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $order->user->name ?? '-' }}</td>
                                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                <td>{{ $order->payment_method === 'transfer' ? 'Transfer' : 'Di Toko' }}</td>
                                <td>
                                    @php
                                    $badges = [
                                    'pending' => 'warning',
                                    'waiting_verification' => 'info',
                                    'paid' => 'success',
                                    'declined' => 'danger',
                                    'canceled' => 'secondary',
                                    ];
                                    $labels = [
                                    'pending' => 'Pending',
                                    'waiting_verification' => 'Verifikasi',
                                    'paid' => 'Lunas',
                                    'declined' => 'Ditolak',
                                    'canceled' => 'Batal',
                                    ];
                                    @endphp
                                    <span class="badge badge-{{ $badges[$order->status] ?? 'secondary' }}">
                                        {{ $labels[$order->status] ?? $order->status }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada order.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
    (function() {
        var labels = @json($chartLabels);
        var revenue = @json($chartRevenue);
        var orders = @json($chartOrders);

        // --- Revenue Line Chart ---
        new Chart(document.getElementById('revenueChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: revenue,
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78,115,223,0.08)',
                    borderWidth: 2,
                    pointBackgroundColor: '#4e73df',
                    pointRadius: 4,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(ctx) {
                                return ' Rp ' + ctx.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(v) {
                                return 'Rp ' + (v / 1000000 >= 1 ? (v / 1000000).toFixed(1) + 'jt' : v.toLocaleString('id-ID'));
                            }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // --- Orders Bar Chart ---
        new Chart(document.getElementById('ordersChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Order',
                    data: orders,
                    backgroundColor: 'rgba(28,200,138,0.7)',
                    borderColor: '#1cc88a',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    })();
</script>
@endpush