<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers     = User::where('role', 'customer')->count();
        $totalProducts  = Product::count();
        $pendingOrders  = Order::where('status', 'pending')->count();
        $totalRevenue   = Order::where('status', 'paid')->sum('total');

        $ordersThisMonth  = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $revenueThisMonth = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->where('status', 'paid')
            ->sum('total');

        // Grafik penjualan 6 bulan terakhir
        $salesData = Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total) as revenue'),
            DB::raw('COUNT(*) as total_orders')
        )
            ->where('status', 'paid')
            ->where('created_at', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Siapkan array 6 bulan terakhir (lengkap, termasuk bulan tanpa data)
        $chartLabels  = [];
        $chartRevenue = [];
        $chartOrders  = [];

        for ($i = 5; $i >= 0; $i--) {
            $date  = now()->subMonths($i);
            $label = $date->translatedFormat('M Y');
            $year  = (int) $date->format('Y');
            $month = (int) $date->format('n');

            $row = $salesData->first(fn($r) => (int)$r->year === $year && (int)$r->month === $month);

            $chartLabels[]  = $label;
            $chartRevenue[] = $row ? (int) $row->revenue : 0;
            $chartOrders[]  = $row ? (int) $row->total_orders : 0;
        }

        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'pendingOrders',
            'totalRevenue',
            'ordersThisMonth',
            'revenueThisMonth',
            'chartLabels',
            'chartRevenue',
            'chartOrders',
            'recentOrders'
        ));
    }
}
