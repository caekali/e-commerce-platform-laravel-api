<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->prefix('/auth')->group(function () {
    Route::post('/register/customer', 'addCustomer');
    Route::post('/register/merchant', 'addMerchant');
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ProductController::class)->prefix('/products')->group(function () {
        Route::get('/', 'index');
        Route::get('/{productId}', 'show');
        Route::put('/{productId}', 'update');
        Route::delete('/{productId}', 'destroy');
        Route::post('/', 'store');
    });
});
