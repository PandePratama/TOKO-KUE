<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        OrderStatusHistory::create([
            'order_id' => $order->id,
            'status'   => 'paid',
            'note'     => 'Pesanan di-approve oleh admin.',
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil di-approve.');
    }

    public function decline(Order $order)
    {
        DB::transaction(function () use ($order) {
            // Kembalikan stok hanya jika order belum pernah di-decline sebelumnya
            if (!in_array($order->status, ['declined', 'canceled'])) {
                $order->load('items.product');
                foreach ($order->items as $item) {
                    if ($item->product) {
                        $item->product->increment('stock_quantity', $item->quantity);
                    }
                }
            }
            $order->update(['status' => 'declined']);

            OrderStatusHistory::create([
                'order_id' => $order->id,
                'status'   => 'declined',
                'note'     => 'Pesanan ditolak oleh admin.',
            ]);
        });

        return redirect()->route('admin.orders.index')->with('error', 'Pesanan ditolak.');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $order = Order::with('items.product')->findOrFail($id);

            // Kembalikan stok hanya dari order yang belum di-decline/canceled
            if (!in_array($order->status, ['declined', 'canceled'])) {
                foreach ($order->items as $item) {
                    if ($item->product) {
                        $item->product->increment('stock_quantity', $item->quantity);
                    }
                }
            }

            $order->delete();
        });

        return redirect()->route('admin.orders.index')->with('success', 'Orderan berhasil dihapus.');
    }
}
