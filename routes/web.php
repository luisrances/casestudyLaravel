<?php

use Illuminate\Support\Facades\Route;

Route::get('admin', function () {
    return view('admin.dashboard.index');
});

Route::get('admin/dashboard', function () {
    return view('admin.dashboard.index');
});

Route::get('admin/customers', function () {
    return view('admin.customers.index');
});

Route::get('admin/products', function () {
    return view('admin.products.index');
});

Route::get('admin/orders', function () {
    return view('admin.orders.index');
});

Route::get('admin/settings', function () {
    return view('admin.settings.index');
});

// crud customer
use App\Http\Controllers\CustomerController;
Route::resource('/admin/customers', CustomerController::class);

// crud product
use App\Http\Controllers\ProductController;
Route::resource('/admin/products', ProductController::class);

// crud order
use App\Http\Controllers\OrderController;
Route::resource('/admin/orders', OrderController::class);

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