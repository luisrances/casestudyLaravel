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
use App\Http\Controllers\FeedbackController;
use App\Models\Wishlist;
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
    Route::view('/wishlists', 'admin.wishlists.index');
    Route::view('/payment_details', 'admin.payment_details.index');
    Route::view('/user_profilings', 'admin.user_profilings.index');
    Route::view('/feedbacks', 'admin.feedback.index');
});
// admin crud
Route::resource('/admin', DashboardController::class);
Route::resource('/admin/accounts', AccountController::class);
Route::resource('/admin/products', ProductController::class);
Route::resource('/admin/orders', OrderController::class);
Route::resource('/admin/carts', CartController::class);
Route::resource('/admin/wishlists', WishlistController::class);
Route::resource('/admin/payment_details', PaymentDetailsController::class);
Route::resource('/admin/user_profilings', UserProfilingController::class);
Route::resource('/admin/dashboard', DashboardController::class);
Route::resource('/admin/feedbacks', FeedbackController::class);

// user profiling page
Route::get('/user-profiling/{account_id}', [UserProfilingController::class, 'createFromRegistration'])
    ->name('create_user_profiling.index'); // for creating user-profiling after signup
Route::post('/user-profiling/register', [UserProfilingController::class, 'storeFormRegistration'])
    ->name('storeFormRegistration.index'); // for submitting the user-profilling

// cart page
Route::get('/cart', [CartController::class, 'cart_user'])->name('cart.user');
Route::post('/cart/update-quantity/{id}', [CartController::class, 'update_quantity_ajax']);
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::put('/cart/{id}', [CartController::class, 'update_quantity'])->name('cart.modify');
Route::post('/cart/add', [CartController::class, 'add_cart'])->name('cart.add');

//checkout page
Route::post('/checkout', [CartController::class, 'checkout_cart'])->name('checkout');
Route::post('/checkout/update-quantity/{id}', [CartController::class, 'update_quantity_ajax']);
Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process');

//wishlist
Route::get('/wishlist', [WishlistController::class, 'wishlist_user'])->name('wishlist.user');
Route::delete('/wishlist/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::post('/wishlist/add', [WishlistController::class, 'add_wishlist'])->name('wishlist.add');
Route::post('/wishlist/cart', [WishlistController::class, 'add_cart_wishlist'])->name('wishlist.cart.add');

//purchase history
Route::get('/purchase_history', [OrderController::class, 'purchase_history_user'])->name('purchase_history.user');
Route::post('/purchase_history/buyAgain', [OrderController::class, 'checkout_buyAgain'])->name('checkout.buyAgain');
Route::post('/purchase_history/buyAgain/single', [OrderController::class, 'checkout_buyAgain_single'])->name('checkout.buyAgain.single');
Route::post('/purchase_history/refund', [OrderController::class, 'refundOrder'])->name('purchase_history.refund');
Route::post('/purchase_history/cancel', [OrderController::class, 'cancelOrder'])->name('purchase_history.cancel');

//account setting
Route::get('/account-setting', [AccountController::class, 'account_show'])->name('account.setting');
Route::patch('/profile/{account}', [AccountController::class, 'account_update'])->name('account.update');
Route::delete('/account-setting/delete', [AccountController::class, 'account_delete'])->middleware('auth')->name('account.delete');
Route::post('/account-setting/address', [PaymentDetailsController::class, 'address_add'])->name('address.add');
Route::put('/account-setting/address/{id}', [PaymentDetailsController::class, 'address_update'])->name('address.update');
Route::delete('/account-setting/address/{paymentDetail}', [PaymentDetailsController::class, 'address_remove'])->name('address.remove');
Route::post('/account-setting/refund', [PaymentDetailsController::class, 'purchaseRefundOrder'])->name('setting.purchase.refund');
Route::post('/account-setting/cancel', [PaymentDetailsController::class, 'purchaseCancelOrder'])->name('setting.purchase.cancel');

// main page
Route::get('/', [ProductController::class, 'home_page'])->name('Home');
Route::get('/shop', [ProductController::class, 'shop_page'])->name('Shop');
Route::get('/feedback', [ProductController::class, 'feedback_page'])->name('Feedback');
Route::post('/feedback/submit', [ProductController::class, 'submit_feedback'])->name('feedback.submit');

Route::get('/dashboard', [ProductController::class, 'home_page'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

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
