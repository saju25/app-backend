<?php

use App\Http\Controllers\AdminWebController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductAddController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductWebController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController as ControllersShopController;
use App\Http\Controllers\ShopWebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\isEmpty;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/payment-fail', function () {
    return view('payment-fail');
});


Route::get('/payment-view/{id}', [PaymentController::class, 'paymentsuccess'])->name('payment_success');

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

    Route::get('/shop', [ShopWebController::class, 'index'])->name('shop.index');
    Route::get('/shop-info', [ShopWebController::class, 'shopinfo'])->name('shop_info');
    Route::put('/shop-update', [ShopWebController::class, 'update'])->name('shop_update');
    Route::get('/shop-order', [ShopWebController::class, 'order'])->name('shop_order');
    Route::get('/product-add', [ProductWebController::class, 'index'])->name('add_view');
    Route::post('/product-add', [ProductWebController::class, 'store'])->name('product_add');
    Route::get('/product-edit/{id}', [ProductWebController::class, 'editview'])->name('edit_view');
    Route::put('/product-edit-store/{id}', [ProductWebController::class, 'update'])->name('product_edit');



        Route::get('/admin-shop-list', [AdminWebController::class, 'index'])->name('admin_index');
        Route::get('/admin-shop-approved/{id}', [AdminWebController::class, 'approved'])->name('approved');
        Route::get('/admin-shop-approved_cancel/{id}', [AdminWebController::class, 'approved_cancel'])->name('approved_cancel');
        Route::get('/admin-driver-list', [AdminWebController::class, 'driver'])->name('driver_index');
        Route::get('/admin-driver-approved/{id}', [AdminWebController::class, 'driver_approved'])->name('driver_approved');
        Route::get('/admin-driver-cancel/{id}', [AdminWebController::class, 'driver_cancel'])->name('driver_cancel');
        Route::get('/admin-banner-list', [BannerController::class, 'index'])->name('banner_index');
        Route::get('/admin-banner-add', [BannerController::class, 'create'])->name('banner_create');
        Route::post('/admin-banner-add-store', [BannerController::class, 'store'])->name('banner_store');
        Route::delete('/admin-banners/{id}', [BannerController::class, 'delete'])->name('banners_delete');
        Route::get('/admin-add', [AdminWebController::class, 'admin'])->name('admin_add');
        Route::post('/admin-add', [AdminWebController::class, 'register'])->name('admin_register');
        Route::get('/admin-list', [AdminWebController::class, 'adminList'])->name('admin_list');
        Route::delete('/admin-list-delete/{id}', [AdminWebController::class, 'adminDelete'])->name('admin_delete');
      
  
});

require __DIR__.'/auth.php';
