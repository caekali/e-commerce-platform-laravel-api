<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->prefix('/auth')->group(function(){
    Route::post('/register/customer','addCustomer');
    Route::post('/register/merchant','addMerchant');
    Route::post('/login','login');
});