<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\stockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'customer'], function () {
    
    Route::get('/products', [ProductController::class, 'getAllProducts']);
    
    Route::post('/order/create', [OrderController::class, 'create']);
});

Route::group(['middleware' => 'admin'], function () {

    Route::get('/products', [ProductController::class, 'getAllProducts']);

    Route::get('/product/{id}', [ProductController::class, 'SingleProduct']);

    Route::post('/products/add', [ProductController::class, 'AddProduct']);

    Route::put('/products/update/{id}', [ProductController::class, 'UpdateProduct']);

    Route::get('/orders', [OrderController::class, 'getAllOrders']);

    Route::post('/order/create', [OrderController::class, 'create']);

    Route::put('/order/update/{id}', [OrderController::class, 'update']);

    Route::get('/order/{id}', [OrderController::class, 'show']);

    Route::get('/inventory/report', [InventoryController::class, 'getReport']);

    Route::get('/sales/report', [SalesController::class, 'getReport']);

    Route::post('/stock/create', [stockController::class, 'createStock']);

    Route::put('/stock/update/{id}', [stockController::class, 'updateStock']);

    Route::get('/stocks', [stockController::class, 'getAllStocks']);
});


//admin 2|6xcg0w6MciaweGTS4H23ZJ8H3NE9Qw7NWnU1pcec

//customer  3|q80Q23RZDcluEMZKJzsC3JicwF6JYzJVSJuhmCT7