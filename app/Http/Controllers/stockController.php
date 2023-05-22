<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class stockController extends Controller
{

    public function createStock(Request $request)
    {

        $stock = Stock::create([

            "quantity" => $request->quantity,
            "product_id" => $request->product_id

        ]);

        $quantity = $stock->quantity;

        $product_id = $stock->product_id;

        DB::update('UPDATE Product SET quantity = quantity + ? WHERE id = ?', [$quantity, $product_id]);

        return $stock;
    }


    public function updateStock(Request $request, $id)
    {

        $stock = Stock::find($id);

        $stock->quantity = $request->quantity;


        $stock->save();



        return response()->json($stock);
    }

    public function getAllStocks()
    {

        $stocks = Stock::all();

        return response()->json($stocks);
    }
}
