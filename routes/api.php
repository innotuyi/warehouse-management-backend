<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/products', [ProductController::class, 'getAllProducts']);

Route::post('/products/add', [ProductController::class, 'AddProduct']);

Route::put('/products/update/{id}', [ProductController::class, 'UpdateProduct']);

Route::get('/products/search/{keyword}', [ProductController::class, 'searchProduct']);


Route::get('/orders', [OrderController::class, 'getAllOrders']);

Route::post('/order/create', [OrderController::class, 'create']);

Route::put('/order/update/{id}', [OrderController::class, 'update']);

Route::get('/order/{id}', [OrderController::class, 'show']);















Route::get('/test', function() {
    return 'test';
});

