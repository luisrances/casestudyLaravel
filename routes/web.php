<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

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
Route::get('/admin/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/admin/customers/create', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/admin/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/admin/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
Route::put('/admin/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('/admin/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

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