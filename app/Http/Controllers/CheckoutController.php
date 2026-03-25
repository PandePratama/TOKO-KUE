<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusHistory;
use App\Models\PickupDate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $cartItems = Cart::where('user_id', $userId)
            ->with('product')
            ->get();

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Ambil semua tanggal libur
        $holidays = PickupDate::pluck('pickup_date')->toArray();

        return view('checkout.index', compact('cartItems', 'total', 'holidays'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:transfer,store',
            'pickup_date'    => 'required|date',
        ]);

        // Ambil semua tanggal libur dari database
        $holidayDates = PickupDate::pluck('pickup_date')->toArray();

        $pickupDate = Carbon::parse($request->pickup_date);
        $today = Carbon::today();
        $minDate = $today->copy()->addDays(3);

        // Validasi minimal H-3
        if ($pickupDate->lt($minDate)) {
            return back()->withErrors([
                'pickup_date' => 'Tanggal pengambilan minimal H-3 dari hari ini.'
            ])->withInput();
        }

        // Validasi tanggal libur
        if (in_array($pickupDate->toDateString(), $holidayDates)) {
            return back()->withErrors([
                'pickup_date' => 'Tanggal yang dipilih adalah tanggal libur pengiriman.'
            ])->withInput();
        }

        $userId = Auth::id();

        $cartItems = Cart::where('user_id', $userId)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kosong!');
        }

        // Validasi stok sebelum checkout
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock_quantity) {
                return back()->withErrors([
                    'stock' => 'Stok produk ' . $item->product->name . ' tidak mencukupi.'
                ]);
            }
        }

        // Gunakan transaksi database
        DB::beginTransaction();

        try {
            // Buat order
            $order = Order::create([
                'user_id'        => $userId,
                'total'          => $cartItems->sum(fn($item) => $item->product->price * $item->quantity),
                'status'         => 'pending',
                'payment_method' => $request->payment_method,
                'pickup_date'    => $pickupDate->toDateString(),
            ]);

            // Catat riwayat status awal
            OrderStatusHistory::create([
                'order_id' => $order->id,
                'status'   => 'pending',
                'note'     => 'Pesanan berhasil dibuat.',
            ]);

            // Simpan order items & kurangi stok
            foreach ($cartItems as $item) {

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                ]);

                // Kurangi stok produk
                $product = $item->product;
                $product->stock_quantity -= $item->quantity;
                $product->save();
            }

            // Upload bukti transfer jika ada
            if ($request->payment_method === 'transfer' && $request->hasFile('payment_proof')) {
                $request->validate([
                    'payment_proof' => [
                        'required',
                        'file',
                        'mimes:jpg,jpeg,png,pdf',
                        'max:5120', // 5 MB
                    ],
                ]);

                $path = $request->file('payment_proof')->store('payments', 'public');

                $order->update([
                    'payment_proof' => $path,
                    'status' => 'waiting_verification'
                ]);

                OrderStatusHistory::create([
                    'order_id' => $order->id,
                    'status'   => 'waiting_verification',
                    'note'     => 'Bukti transfer diunggah, menunggu verifikasi admin.',
                ]);
            }

            // Hapus cart
            Cart::where('user_id', $userId)->delete();

            DB::commit();

            return redirect()->route('checkout.success', $order->id)
                ->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan saat checkout.');
        }
    }

    public function success($id)
    {
        $order = Order::with(['items.product', 'statusHistories'])->findOrFail($id);
        return view('checkout.success', compact('order'));
    }

    public function uploadProof(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:5120', // maks 5 MB
            ],
        ]);

        $order = Order::findOrFail($id);

        $path = $request->file('payment_proof')->store('payments', 'public');

        $order->update([
            'payment_proof' => $path,
            'status' => 'waiting_verification'
        ]);

        OrderStatusHistory::create([
            'order_id' => $order->id,
            'status'   => 'waiting_verification',
            'note'     => 'Bukti transfer diunggah, menunggu verifikasi admin.',
        ]);

        return redirect()->route('checkout.success', $id)
            ->with('success', 'Bukti transfer berhasil diupload, menunggu verifikasi.');
    }

    public function downloadInvoice($id)
    {
        $order = Order::with(['items.product', 'user', 'statusHistories'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $pdf = Pdf::loadView('invoice.invoice', compact('order'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('invoice-' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . '.pdf');
    }
}
