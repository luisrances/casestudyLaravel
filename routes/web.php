<?php

use Illuminate\Support\Facades\Route;

Route::get('admin', function () {
    return view('dashboard.index');
});

Route::get('admin/dashboard', function () {
    return view('dashboard.index');
});

Route::get('admin/customers', function () {
    return view('customers.index');
});

Route::get('admin/products', function () {
    return view('products.index');
});

Route::get('admin/transactions', function () {
    return view('transactions.index');
});

Route::get('admin/settings', function () {
    return view('settings.index');
});

// crud customer
use App\Http\Controllers\CustomerController;
Route::resource('/admin/customers', CustomerController::class);

// crud product
use App\Http\Controllers\ProductController;
Route::resource('/admin/products', ProductController::class);

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