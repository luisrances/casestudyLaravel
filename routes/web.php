<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PaymentDetailsController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// admin page
Route::prefix('admin')->group(function () {
    Route::view('/', 'admin.dashboard.index');
    Route::view('/dashboard', 'admin.dashboard.index');
    Route::view('/accounts', 'admin.accounts.index');
    Route::view('/products', 'admin.products.index');
    Route::view('/orders', 'admin.orders.index');
    Route::view('/carts', 'admin.carts.index');
    Route::view('/carts', 'admin.wishlists.index');
    Route::view('/payment_details', 'admin.payment_details.index');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', function () {
    return view('admin.dashboard.index');
})->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// crud customer
Route::resource('/admin/accounts', AccountController::class);

// crud product
Route::resource('/admin/products', ProductController::class);

// crud order
Route::resource('/admin/orders', OrderController::class);

// crud cart
Route::resource('/admin/carts', CartController::class);

// crud wiishlist
Route::resource('/admin/wishlists', WishlistController::class);

// crud wiishlist

Route::resource('/admin/payment_details', PaymentDetailsController::class);


// db check if active
Route::get('/db-check', function () {
    try {
        DB::connection()->getPdo();
        return "Connected to DB: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "Not connected: " . $e->getMessage();
    }
});
require __DIR__.'/auth.php';
