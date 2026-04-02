<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // =========================
    // ADMIN
    // =========================

    public function index()
    {
        $products = Product::with('primaryImage')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // simpan produk TANPA image
        $product = Product::create($validated);

        // simpan image ke product_images
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');

            $product->images()->create([
                'image_path' => $path,
                'is_primary' => true,
            ]);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(Product $product)
    {
        $product->load('primaryImage');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load('primaryImage');
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $product->update($validated);

        if ($request->hasFile('image')) {

            // hapus image lama
            foreach ($product->images as $img) {
                Storage::disk('public')->delete($img->image_path);
            }
            $product->images()->delete();

            // simpan image baru
            $path = $request->file('image')->store('products', 'public');

            $product->images()->create([
                'image_path' => $path,
                'is_primary' => true,
            ]);
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }

        $product->images()->delete();
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus');
    }

    // =========================
    // FRONTEND
    // =========================

    public function mainPage()
    {
        $products = Product::with('primaryImage')
            ->latest()
            ->take(4)
            ->get();

        return view('mainpage', compact('products'));
    }

    public function showDetail(Product $product)
    {
        $product->load('primaryImage');

        $related = Product::with('primaryImage')
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('product-detail', compact('product', 'related'));
    }
}
