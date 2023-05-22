<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function getReport()
    {

        $sales = Order::select('product_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(price) as total_revenue'))
             ->groupBy('product_id')
             ->get();


        return response()->json($sales);
    }

    public function getRevenueReport() {

        $revenue = Order::select(DB::raw('SUM(price) as total_revenue'), DB::raw('AVG(price) as average_revenue'))
                ->get();

         return $revenue;

    }
    
}
