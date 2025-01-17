<?php

use App\Http\Controllers\Api\ProductAddController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// OTP Verified Route
Route::post('verifyotp', [RegisteredUserController::class, 'useractivation'])->name('verifyotp');
Route::get('/verify-otp/{user}', [RegisteredUserController::class, 'verifyOtpByUser'])->name('otp-verify');
Route::get('/resend-otp/{user}', [RegisteredUserController::class, 'resendOtp'])->name('resend-otp');





Route::middleware('auth','verified')->group(function () {
    Route::get('/dashboard', function () {return view('dashboard'); })->name('dashboard');  

    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/add-product', [ProductAddController::class, 'formShow'])->name('product.show');
    Route::post('/add-product', [ProductAddController::class, 'store'])->name('products.store');
    Route::get('/add-shop', [ShopController::class, 'formShow'])->name('shop.show');
    Route::post('/add-shop', [ShopController::class, 'store'])->name('shops.store');
});

require __DIR__.'/auth.php';
