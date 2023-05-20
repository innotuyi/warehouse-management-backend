<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function getAllOrders() {

        $orders = Order::all();

          return response()->json($orders);
    
        }

    public function create(Request $request) {
      
            $order = Order::create([
                'customer_id' => $request->customer_id,
                'product_id' => $request->product_id,
                'order_date' => $request->order_date,
                'status' => $request->status
            ]);

            $order_id = $order->id;

        

             $product = Product::find($order->product_id);
             

           $orderItem = OrderItem::create([

                'order_id' => $order_id,

                'quantity' => $request->quantity,

                'price' => $product->price,


            ]);

            $remainQuantity = $orderItem->quantity;

         DB::select(`SELECT quantity-$remainQuantity  FROM Product  WHERE id= ?`, [$order->product_id]);

          
        return response()->json($orderItem, 201);



    }

    public function update( Request $request, $orderId)
    {

        $order = Order::findOrFail($orderId);


        if(is_null($order)) {

            return response()->json('no order found');
        }

        $order->update(['status' => $request->status]);

        return response()->json($order);
    }

   




    public function show($id)
    {


        $order = Order::find($id);

        if(!$order) {

           return response()->json(['msg'=>"no order found"]);
        }

        return response()->json($order);
    }

}
