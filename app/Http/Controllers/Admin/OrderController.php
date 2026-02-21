<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product', 'pickupDate'])->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function approve(Order $order)
    {
        $order->update(['status' => 'paid']);
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil di-approve.');
    }

    public function decline(Order $order)
    {
        $order->update(['status' => 'declined']);
        return redirect()->route('admin.orders.index')->with('error', 'Pesanan ditolak.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Orderan berhasil dihapus.');
    }
}
