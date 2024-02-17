<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::controller(App\Http\Controllers\FrontendController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::get('/shop', 'shop')->name('shop');
    Route::get('/shopDetail/{id}', 'shopDetail')->name('shopDetail');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('login/google/redirect', 'redirectToGoogle')->middleware(['guest'])->name('redirectToGoogle');
    Route::get('login/google/callback', 'googleCallback')->middleware(['guest'])->name('googleCallback');
    Route::middleware(['auth'])->group(function () {
        Route::get('/cart', 'cart')->name('cart');
        Route::post('/post_cart', 'post_cart')->name('post_cart');
        Route::post('/plus_cart', 'plus_cart')->name('plus_cart');
        Route::post('/minus_cart', 'minus_cart')->name('minus_cart');
        Route::delete('/delete_cart', 'delete_cart')->name('delete_cart');
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::post('/post_checkout', 'post_checkout')->name('post_checkout');
        Route::get('/payment/{id}', 'payment')->name('payment');
        Route::post('/post_payment', 'post_payment')->name('post_payment');
        Route::get('/midtrans/{id}', 'midtrans')->name('midtrans');
        Route::post('/midtrans_notify', 'midtrans_notify')->name('midtrans_notify');
        Route::post('/formAdmin', 'formAdmin')->name('formAdmin');
        Route::post('/payments_finish', 'payments_finish')->name('payments_finish');
        Route::post('logout', 'logout')->name('logout');
    });
});

Auth::routes([
    'login'    => true,
    'logout'   => true,
    'register' => true,
    'reset'    => false,
    'confirm'  => false,
    'verify'   => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/formAdmin', [App\Http\Controllers\HomeController::class, 'formAdmin'])->name('formAdmin');
Route::post('/addProd', [App\Http\Controllers\HomeController::class, 'addProd'])->name('addProd');
