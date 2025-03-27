<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->prefix('/auth')->group(function () {
    Route::post('/register/customer', 'addCustomer');
    Route::post('/register/merchant', 'addMerchant');
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', function (Request $request) {
        return $request->user();
    });

    Route::controller(ProductController::class)->group(function () {
        Route::prefix('/products')->group(function () {
            Route::get('/', 'index');
            Route::get('/{productId}', 'show');
        });

        Route::prefix('/merchants')->group(function () {
            Route::get('/{merchantId}/products', 'getProductsByMerchant');
            Route::put('/{merchantId}/{productId}',  'update');
            Route::delete('/{merchantId}/products/{productId}', 'destroy');
            Route::post('/{merchantId}/products', 'store');
        });
    });


    Route::controller(MerchantController::class)->prefix('/merchants')->group(function () {
        Route::get('/', 'index');
        Route::get('/{merchantId}', 'show');
        Route::put('/{merchantId}', 'update');
        Route::delete('/{merchantId}', 'destroy');
    });

    Route::controller(CustomerController::class)->prefix('/customers')->group(function () {
        Route::get('/', 'index');
        Route::get('/{customerId}', 'show');
        Route::put('/{customerId}', 'update');
        Route::delete('/{customerId}', 'destroy');
    });

    Route::controller(CartController::class)->prefix('/cart')->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::put('/{cartId}', 'update');
        Route::delete('/{cartId}', 'destroy');
    });

    Route::controller(OrderController::class)->prefix('/orders')->group(function () {
        Route::get('/', 'index');
        Route::get('/{orderId}', 'show');
        Route::post('/', 'store');
        Route::put('/{orderId}/cancel', 'update');
        Route::delete('/{orderId}', 'destroy');
    });


    // GET /merchants/{id}/orders
    // GET /categories → Get all categories

    // POST /categories → Create a category (Admin only)

    // DELETE /categories/{id} → Remove a category (Admin only)



    // PUT /merchants/{id}/orders/{orderId}/status → Update order status (e.g., Processing, Shipped, Delivered)

    // POST /payments → Make a payment

    // GET /payments/{id} → Get payment details


});
