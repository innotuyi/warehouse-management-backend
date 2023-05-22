<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{

    public function create($product_id,$quantity,$price  )
    {


        $product = Product::find($product_id);

        $price   = $product->price;

        $user = Auth::user();

        if ($user->role === 'customer') {
            $order = Order::create([
                'customer_id' => $user->id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'price' => $price,
            ]);
        }

        $order = Order::create([
            'customer_id' => $user->id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' =>  $price,

        ]);

        $product = Product::find($order->product_id);

        $quantity = $order->quantity;

        DB::update('UPDATE Product SET quantity = quantity - ? WHERE id = ?', [$quantity, $product->id]);

        DB::update('UPDATE Stock SET quantity = quantity - ? WHERE id = ?', [$quantity, $product->id]);

      return  $order;

    }

    


    
}
