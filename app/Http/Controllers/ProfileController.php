<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // ✅ Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed', // kalau mau konfirmasi password tambahkan field "password_confirmation"
        ]);

        // ✅ Update data user
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone_number = $validated['phone_number'] ?? null;

        // ✅ Jika password diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }

    public function orders()
    {
        $user = Auth::user();

        // Ambil semua pesanan user dengan relasi order_items
        $orders = Order::where('user_id', $user->id)
            ->with('items.product')
            ->orderByDesc('created_at')
            ->get();

        return view('profile.orders', compact('orders', 'user'));
    }
}
