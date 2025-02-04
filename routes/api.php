<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ShopController;
use App\Http\Controllers\Api\ShopApprovedController;
use App\Http\Controllers\Api\AddToCartController;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\DeliveryManLocationController;
use App\Http\Controllers\Api\DeliveryRequestController;
use App\Http\Controllers\Api\DmController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PrescriptionOrderController;
use App\Http\Controllers\Api\ProductAddController;
use App\Http\Controllers\Api\ShopLocationController;
use App\Http\Controllers\DeliveryFeeController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// OTP Verified Route
Route::post('verifyotp/{id}', [RegisterController::class, 'otpVerification'])->name('verifyotp');
Route::get('/resend-otp/{id}', [RegisterController::class, 'resendOtp'])->name('resend-otp');
Route::get('/resend-otp-email/{email}', [RegisterController::class, 'resendOtpInemail'])->name('resend-otp-email');
Route::post('/password-change-by-otp/{id}', [RegisterController::class, 'passwordChange'])->name('passwordc_hange');





Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'login'])->name('api-login');
Route::middleware('auth:sanctum')->group(function () {
    // User-related routes
    Route::get('/user', [UserController::class, 'getUserData']);
    Route::get('/user-order-verify/{id}', [UserController::class, 'getUserOrder']);
    Route::get('/user-shop/{id}', [UserController::class, 'shopUser']);
    Route::get('/user-driver/{id}', [UserController::class, 'driverUser']);
    Route::get('/user-order/{id}', [UserController::class, 'orderUser']);
    
    // Shop-related routes
    Route::post('/add-shop', [ShopController::class, 'store']);
    Route::put('/rate-shop/{id}', [ShopController::class, 'shopRating']);
    Route::get('/shop-approved', [ShopApprovedController::class, 'getShopData']);
    Route::get('/shop', [ShopApprovedController::class, 'getShop']);
    Route::get('/shop/{id}', [ShopController::class, 'shop']);
    Route::get('/shop-data/{id}', [ShopController::class, 'shopdata']);
    Route::get('/shop-product/{id}', [ShopApprovedController::class, 'getProduct']);

    // Cart-related routes
    Route::delete('/delete-cart/{id}', [AddToCartController::class, 'destroy']);
    Route::get('/product', [ProductAddController::class, 'getProduct']);
    Route::get('/cart', [AddToCartController::class, 'index']);
    Route::post('/add-cart', [AddToCartController::class, 'store']);
    Route::put('/updata-cart/{id}', [AddToCartController::class, 'update']);
    
    // Order-related routes
    Route::post('/place-order', [OrderController::class, 'placeOrder']);
    Route::post('/Prescription-order', [PrescriptionOrderController::class, 'PrescriptionOrder']);
    Route::post('/update-order/{id}', [OrderController::class, 'updateOrder']);
    Route::get('/order', [OrderController::class, 'getOrder']);
    Route::get('/shop-order/{id}', [OrderController::class, 'shopOrder']);
    Route::get('/accept-order/{driver_id}', [OrderController::class, 'getAcceptOrder']);
    Route::get('/order/{id}', [OrderController::class, 'getSpec_Order']);
    
    // Shop Location-related routes
    Route::post('/shop-locations', [ShopLocationController::class, 'store']);
    Route::post('/shop-locations-update/{id}', [ShopLocationController::class, 'updates']);
    Route::get('/get-shop-locations', [ShopLocationController::class, 'getLocation']);
    Route::get('/get-shop-locations-map', [ShopLocationController::class, 'getLocationmap']);
    
    // Direct Messaging-related routes
    Route::post('/add-dm', [DmController::class, 'store']);
    Route::get('/get-dm', [DmController::class, 'getDm']);
    
    // Delivery Man Location-related routes
    Route::post('/driver-locations', [DeliveryManLocationController::class, 'store']);
    Route::put('/driver-locations-update', [DeliveryManLocationController::class, 'update']);
    Route::get('/driver-locations', [DeliveryManLocationController::class, 'getLocation']);
    Route::get('/delivery-man-locations', [DeliveryManLocationController::class, 'deliverynamLocationGet']);
    
    // Delivery Request-related routes
    Route::post('/delivery-requests', [DeliveryRequestController::class, 'store']);
    Route::get('/delivery-requests/{driver_id}/{order_id}', [DeliveryRequestController::class, 'getDeliveryRequest']);
    Route::delete('/delivery-requests/{driver_id}/{order_id}', [DeliveryRequestController::class, 'destroy']);
    Route::get('/delivery-request-list/{driver_id}', [DeliveryRequestController::class, 'getList']);
    Route::delete('/delivery-request-accept/{id}', [DeliveryRequestController::class, 'acceptRequest']);
    
    // Driver-related routes
    Route::get('/driver/{id}', [DriverController::class, 'getDriverData']);
   
    // Delivery Free routes
    Route::post('/free-add', [DeliveryFeeController::class, 'store']);
    Route::get('/free-get', [DeliveryFeeController::class, 'index']);

    //banner routes
    Route::get('/banner', [BannerController::class, 'index']);
    
    // Order completion-related routes
    Route::put('/complete-order/{id}', [OrderController::class, 'completeOrder']);
    Route::put('/complete-order-accept/{id}', [OrderController::class, 'completeOrderAccept']);

    //Logout related route
    Route::post('/logout', [LogoutController::class, 'logout']);

});

