<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\Product;

class ProductService
{


    public function getAllProducts()
    {


        $products = Product::all();

        return $products;
    }

    public function SingleProduct($id)
    {

        $product = Product::find($id);

        if (is_null($product)) {

            return response()->json('no product found');
        }

        return $product;
    }

    public function AddProduct($name, $description, $price)
    {


        $product=Product::create([

            'name' => $name,
            'description' => $description,
            'price' => $price,
        ]);

        return $product;
    }


    public function  UpdateProduct($id, $name, $description, $price)
    {


        $product = Product::find($id);

        if (!$product) {

            return response()->json(['msg' => "no product found"]);
        }



        return    Product::where('id', $id)->update([

            'name' => $name,

            'description' => $description,

            'price' => $price,

        ]);
    }


    
}
