<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    public function getReport() {
     
        $products = Product::select('name', 'quantity')->get();

        $reportData = [];

        foreach ($products as $product) {

            $reportData[] = [
                'Product' => $product->name,
                'Quantity' => $product->quantity,
            ];
        }

        return $reportData;
    }
    
}
