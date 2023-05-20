<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    


    public function getAllProducts() {


        $products = Product::all();

        return response()->json($products);


    }

    public function AddProduct(Request $request) {



        //   $validatedData = $request->validate([
        //     'name' => 'required',
        //     'description' => 'required|string',
        //     'quantity' => 'required|integer|min:1',
        //     'price'=> 'required|integer|min:1',
        // ]);


       return  Product::create([

            'name' => $request->name,

            'description' => $request->description,

            'quantity' => $request->quantity,

            'price'=> $request->price,


       ]);


    }


    public function  UpdateProduct(Request $request, $id) {


         $product = Product::find( $id);

         if(!$product) {

            return response()->json(['msg'=>"no product found"]);
         }



     return    Product::where('id', $id)->update([

            'name' => $request->name,

            'description' => $request->description,

            'quantity' => $request->quantity,

            'price'=> $request->price,
            
        ]);

    }

    public function searchProduct($keyword) {


        $products = Product::find('name', $keyword);

        if(!$products) {

            return response()->json(['msg'=>"no product found "]);
        }

        return response()->json($products);



    }


}
