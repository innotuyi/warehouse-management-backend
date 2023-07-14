<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardStatistics;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\stockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'customer'], function () {
    
    Route::get('/products', [ProductController::class, 'getAllProducts']);

    Route::get('/customer/orders', [ProductController::class, 'getAllcustomerOrders']);
    
    Route::post('/order/create', [OrderController::class, 'create']);
});

Route::put('/products/update/{id}', [ProductController::class, 'UpdateProduct']);

Route::group(['middleware' => 'admin'], function () {

    Route::get('/customer/orders', [ProductController::class, 'getAllcustomerOrders']);

    Route::get('/products', [ProductController::class, 'getAllProducts']);

    Route::get('/product/{id}', [ProductController::class, 'SingleProduct']);

    Route::post('/products/add', [ProductController::class, 'AddProduct']);

    Route::get('/orders', [OrderController::class, 'getAllOrders']);

    Route::post('/order/create', [OrderController::class, 'create']);

    Route::put('/order/update/{id}', [OrderController::class, 'update']);

    Route::get('/order/{id}', [OrderController::class, 'show']);

    Route::get('/inventory/report', [InventoryController::class, 'getReport']);

    Route::get('/sales/report', [SalesController::class, 'getReport']);

    Route::get('/revenue/report', [SalesController::class, 'getRevenueReport']);

    Route::get('/customers/report', [OrderController::class, 'getCustomersReport']);

    Route::post('/stock/create', [stockController::class, 'createStock']);

    Route::put('/stock/update/{id}', [stockController::class, 'updateStock']);

    Route::get('/stocks', [stockController::class, 'getAllStocks']);

    Route::get('/dashboard/statistics/stock', [DashboardStatistics::class, 'getStockQuantity']);

    Route::get('/dashboard/statistics/product', [DashboardStatistics::class, 'getTotalProduct']);

    Route::get('/dashboard/statistics/order', [DashboardStatistics::class, 'getTotalOrder']);



});


//admin 1|uarHHumCx7qzqmvj8zRygR28iNbEO4g6FF8iwQ0b

//customer 2|nGZUhqkswmFbi9JwZ70JIOq6CVYqZTtwOSvQtzpA