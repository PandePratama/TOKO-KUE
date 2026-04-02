<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Menampilkan daftar keranjang belanja
     */
    public function index()
    {
        // Ambil keranjang user login (atau semua keranjang kalau belum ada sistem login)
        $carts = Cart::with('product')
            ->when(Auth::check(), function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->get();

        return view('cart.index', compact('carts'));
    }

    /**
     * Menambahkan produk ke keranjang
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:20',
        ]);

        $cart = Cart::where('product_id', $request->product_id)
            ->when(Auth::check(), function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->first();

        if ($cart) {
            // Kalau produk sudah ada di keranjang → tambah quantity
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            // Kalau belum ada → buat baru
            Cart::create([
                'user_id'    => Auth::id() ?? null,
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    /**
     * Update jumlah produk di keranjang
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        // Jika user klik tombol + atau -
        if ($request->has('action')) {
            if ($request->action === 'increase') {
                $cart->quantity += 1;
            } elseif ($request->action === 'decrease') {
                $cart->quantity -= 1;

                // Jika quantity < 20 → kembalikan minimal 20
                if ($cart->quantity < 20) {
                    $cart->quantity = 20;
                }

                // Jika quantity 0 atau kurang → hapus produk
                if ($cart->quantity <= 0) {
                    $cart->delete();
                    return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang');
                }
            }
        }
        // Jika user mengetik jumlah manual di input number
        elseif ($request->has('quantity')) {
            $newQty = (int) $request->quantity;

            // Validasi minimal 20
            if ($newQty < 20) {
                $newQty = 20;
            }

            $cart->quantity = $newQty;
        }

        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui');
    }


    /**
     * Hapus produk dari keranjang
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang');
    }

    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan');
    }
}
