<?php

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

// crud customer
use App\Http\Controllers\AccountController;
Route::resource('/admin/accounts', AccountController::class);

// crud product
use App\Http\Controllers\ProductController;
Route::resource('/admin/products', ProductController::class);

// crud order
use App\Http\Controllers\OrderController;
Route::resource('/admin/orders', OrderController::class);

// crud cart
use App\Http\Controllers\CartController;
Route::resource('/admin/carts', CartController::class);

// crud wiishlist
use App\Http\Controllers\WishlistController;
Route::resource('/admin/wishlists', WishlistController::class);

// crud wiishlist
use App\Http\Controllers\PaymentDetailsController;
Route::resource('/admin/payment_details', PaymentDetailsController::class);


// db check if active
use Illuminate\Support\Facades\DB;
Route::get('/db-check', function () {
    try {
        DB::connection()->getPdo();
        return "Connected to DB: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "Not connected: " . $e->getMessage();
    }
});