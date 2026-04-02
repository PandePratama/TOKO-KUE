<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('wishlist.index', compact('wishlists'));
    }

    public function store($productId)
    {
        $userId = Auth::id();

        $exists = Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->exists();

        if ($exists) {
            return back()->with('info', 'Produk sudah ada di wishlist kamu.');
        }

        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan ke wishlist!');
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $wishlist->delete();

        return back()->with('success', 'Produk dihapus dari wishlist.');
    }
}
