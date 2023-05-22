<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function getReport()
    {

        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();

        $salesData = Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date,  COUNT(*) as orders')
            ->groupBy('date')
            ->get();   

        return response()->json($salesData);
    }
}
