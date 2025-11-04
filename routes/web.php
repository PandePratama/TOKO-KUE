<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PickupDateController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', [ProductController::class, 'mainPage'])->name('mainpage');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');


// Detail produk
Route::get('/product/{id}', [ProductController::class, 'showDetail'])->name('product.detail');

// List produk publik
Route::get('/products', [ProductController::class, 'index'])->name('products.public');

// | Authentication (Login, Register, Logout)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// | Admin Routes (Hanya Bisa Diakses Admin)
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Produk
    Route::resource('products', ProductController::class)->names('products');

    // Customer
    Route::get('customers', [CustomerController::class, 'index'])->name('customers.index');

    // Orders
    Route::resource('orders', AdminOrderController::class)
        ->only(['index', 'show', 'destroy'])
        ->names('orders');
    Route::post('orders/{order}/approve', [AdminOrderController::class, 'approve'])->name('orders.approve');
    Route::post('orders/{order}/decline', [AdminOrderController::class, 'decline'])->name('orders.decline');

    // Pickup Date
    Route::resource('pickup-dates', PickupDateController::class)->only(['index', 'store', 'destroy']);
});

// User Routes (Butuh Login)
Route::middleware('auth')->group(function () {

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{id}', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::post('/checkout/upload/{id}', [CheckoutController::class, 'uploadProof'])->name('checkout.upload');

    // Profile User
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
});
