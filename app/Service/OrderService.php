<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{

    public function create($product_id, $quantity)
    {


        try {
            DB::transaction(function () use ($product_id, $quantity) {

                $product = Product::find($product_id);
                $price = $product->price;

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
                    'price' => $price,
                ]);

                $product = Product::find($order->product_id);
                $quantity = $order->quantity;
                $product->quantity -= $quantity;
                $product->save();

            DB::select('UPDATE Stock SET quantity = quantity - ? WHERE product_id = ?', [$quantity, $product->id]);
           
            });
        } catch (QueryException $e) {

            return response()->json(['error' => $e->getMessage()]);
        } catch (\Exception $e) {

            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
}
