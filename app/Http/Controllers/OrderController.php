<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Service\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function __construct(protected OrderService $service)
    {
    }

    public function getAllOrders()
    {

        $user = Auth::user();

        $orders = Order::select('Order_tbl.id as order_id', 'Product.name as product_name', 'users.name as customer_name', 'Order_tbl.quantity', 'Product.price', 'Order_tbl.status', 'Order_tbl.created_at')
            ->join('Product', 'Product.id', '=', 'Order_tbl.product_id')
            ->join('users', 'users.id', '=', 'Order_tbl.customer_id')
            ->where('users.id', $user->id)
            ->get();

        return response()->json($orders);
    }

    public function create(Request $request)
    {

        try {
            $order =  $this->service->create(
                $request->product_id,
                $request->quantity,
                $request->price
            );

            return response()->json($order, 201);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $orderId)
    {

        $order = Order::findOrFail($orderId);


        if (is_null($order)) {

            return response()->json('no order found');
        }

        $order->update(['status' => $request->status]);

        return response()->json($order);
    }


    public function show($id)
    {


        $order = Order::find($id);

        if (!$order) {

            return response()->json(['msg' => "no order found"]);
        }

        return response()->json($order);
    }


    public function getAllcustomerOrders()
    {
        $user = Auth::user();

        $orders = Order::where('customer_id', $user->id)->get();

        return response()->json($orders);
    }

    public function getRevenueReport()
    {

        $revenue = Order::select(DB::raw('SUM(price) as total_revenue'), DB::raw('AVG(price) as average_revenue'))
            ->get();

        return $revenue;
    }

    public function getCustomersReport()
    {

        $customers = Order::select('customer_id', DB::raw('COUNT(*) as order_count'), DB::raw('AVG(price) as average_order_value'))
            ->groupBy('customer_id')
            ->orderByDesc('order_count')
            ->get();

        return $customers;
    }
    
    
}
