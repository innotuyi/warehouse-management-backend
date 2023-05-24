<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class DashboardStatistics extends Controller
{

    public function getStockQuantity() {

        $totalItemsInStock = Stock::sum('quantity');

        return $totalItemsInStock;

    }

    public function getTotalProduct() {

        $totalProducts = Product::count();

         return $totalProducts;
    }

    public function getTotalOrder() {

        $totalOrders = Order::count();

        return $totalOrders;
        
    }
    

}
