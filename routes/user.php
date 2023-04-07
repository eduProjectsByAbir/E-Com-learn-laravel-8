<?php

use App\Http\Controllers\Frontend\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\UserController;

Route::middleware(['auth:sanctum,web', config('jetstream.auth_session'), 'verified'])->prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('home');
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'edit'])->name('profile');
    Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update');
    Route::get('/change/password', [UserController::class, 'editPassword'])->name('profile.password');
    Route::put('/update/password', [UserController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/wishlist', [UserController::class, 'wishlist'])->name('wishlist');
    Route::get('/cart', [UserController::class, 'myCart'])->name('mycart');
    Route::get('/orders', [UserController::class, 'myOrders'])->name('myorders');
    Route::get('/order/details/{id}', [UserController::class, 'myOrderDetails'])->name('myorder.details');
    Route::get('/order/invoice/{id}', [UserController::class, 'myOrderInvoice'])->name('myorder.invoice');

    Route::controller(CheckoutController::class)->group(function () {
        Route::post('/checkout', 'OrderStore')->name('checkout');
        Route::post('/checkout-stripe', 'OrderStoreStripe')->name('checkout.stripe');
        Route::post('/checkout-sslcommerz', 'OrderStoreSSLCommerz')->name('checkout.sslcommerz');
        Route::post('/checkout-cod', 'OrderStoreCOD')->name('checkout.cod');
    });
});