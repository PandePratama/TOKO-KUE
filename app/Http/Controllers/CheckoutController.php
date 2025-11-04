<?php

// app/Http/Controllers/CheckoutController.php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PickupDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Ambil semua tanggal libur
        $holidays = PickupDate::pluck('pickup_date')->toArray();

        return view('checkout.index', compact('cartItems', 'total', 'holidays'));
    }

    public function store(Request $request)
    {
        // Ambil semua tanggal libur dari database
        $holidayDates = PickupDate::pluck('pickup_date')->toArray();

        $request->validate([
            'payment_method' => 'required|in:transfer,store',
            'pickup_date' => 'required|date',
        ]);

        $pickupDate = \Carbon\Carbon::parse($request->pickup_date);
        $today = \Carbon\Carbon::today();
        $minDate = $today->copy()->addDays(3);

        // ✅ Validasi 1: minimal H-3
        if ($pickupDate->lt($minDate)) {
            return back()->withErrors([
                'pickup_date' => 'Tanggal pengambilan minimal H-3 dari hari ini.'
            ])->withInput();
        }

        // ✅ Validasi 2: tidak boleh tanggal libur
        if (in_array($pickupDate->toDateString(), $holidayDates)) {
            return back()->withErrors([
                'pickup_date' => 'Tanggal yang dipilih adalah tanggal libur pengiriman.'
            ])->withInput();
        }

        // Ambil keranjang user
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        // ✅ Buat order baru
        $order = Order::create([
            'user_id'        => $userId,
            'total'          => $cartItems->sum(fn($item) => $item->product->price * $item->quantity),
            'status'         => 'pending',
            'payment_method' => $request->payment_method,
            'pickup_date'    => $pickupDate->toDateString(),
        ]);

        // Simpan item pesanan
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->price,
            ]);
        }

        if ($request->payment_method === 'transfer' && $request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payments', 'public');
            $order->update([
                'payment_proof' => $path,
                'status' => 'waiting_verification'
            ]);
        }

        // Hapus keranjang setelah checkout
        Cart::where('user_id', $userId)->delete();

        return redirect()->route('checkout.success', $order->id)
            ->with('success', 'Pesanan berhasil dibuat!');
    }


    public function success($id)
    {
        $order = Order::findOrFail($id);
        return view('checkout.success', compact('order'));
    }

    public function uploadProof(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $order = Order::findOrFail($id);

        $path = $request->file('payment_proof')->store('payments', 'public');
        $order->update([
            'payment_proof' => $path,
            'status' => 'waiting_verification'
        ]);

        return redirect()->route('checkout.success', $id)
            ->with('success', 'Bukti transfer berhasil diupload, menunggu verifikasi.');
    }
}
