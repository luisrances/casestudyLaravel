<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\PaymentDetailsController;
use App\Http\Controllers\UserProfilingController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    Route::view('/user_profilings', 'admin.user_profilings.index');
});
// crud
Route::resource('/admin/accounts', AccountController::class);
Route::resource('/admin/products', ProductController::class);
Route::resource('/admin/orders', OrderController::class);
Route::resource('/admin/carts', CartController::class);
Route::resource('/admin/wishlists', WishlistController::class);
Route::resource('/admin/payment_details', PaymentDetailsController::class);
Route::resource('/admin/user_profilings', UserProfilingController::class);
Route::resource('/admin/dashboard', DashboardController::class);
Route::resource('/admin', DashboardController::class);
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

Route::get('/user-profiling/{account_id}', [UserProfilingController::class, 'createFromRegistration'])
    ->name('create_user_profiling.index'); // for creating user-profiling after signup
Route::post('/user-profiling/register', [UserProfilingController::class, 'storeFormRegistration'])
    ->name('storeFormRegistration.index'); // for submitting the user-profilling


Route::get('/', function () { // login page
    return view('welcome');
})->name('Home');

Route::get('/shop', function () {
    return view('Shop');
})->name('Shop');

Route::get('/feedback', function () {
    return view('Feedback');
})->name('Feedback');

Route::get('/dashboard', function () { // dashboard after login
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/admin', function () {
//     return view('admin.dashboard.index');
// })->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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
