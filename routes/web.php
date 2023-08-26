<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
    Route::get('/test', function (){
        dd(\App\Http\Helpers\Hashing::generateKashierOrderHash('ahmrd'));
    });
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/cart',  [\App\Http\Controllers\CartController::class, 'index'])->name('cart');
    Route::post('/addtocart',  [\App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart');
    Route::post('/removefromcart',  [\App\Http\Controllers\CartController::class, 'removeFromCart'])->name('removeFromCart');
    Route::post('/reducequantity',  [\App\Http\Controllers\CartController::class, 'changeQuantity'])->name('changeQuantity');
    Route::get('/checkout',  [\App\Http\Controllers\CheckOutController::class, 'index'])->name('checkout')->middleware('redirectOnly');
    Route::post('/placeorder',  [\App\Http\Controllers\CheckOutController::class, 'createOrder'])->name('placeOrder');
    Route::get('/paynow',  [\App\Http\Controllers\PaymentController::class, 'index'])->name('payment')->middleware('redirectOnly');
    Route::get('/payment-success',  [\App\Http\Controllers\PaymentController::class, 'paymentSuccess'])->name('success')->middleware('redirectOnly');

