<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Service\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct(protected OrderService $service)
    {
    }

    public function getAllOrders()
    {

        $orders = Order::all();

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
}
