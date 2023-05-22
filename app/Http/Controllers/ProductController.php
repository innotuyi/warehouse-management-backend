<?php

namespace App\Http\Controllers;
use App\Service\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{



    public function __construct(protected ProductService $service)
    {
    }

    public function getAllProducts()
    {

        $products =  $this->service->getAllProducts();

        return response()->json($products);
    }


    public function SingleProduct($id)
    {


        $products =  $this->service->SingleProduct($id);

        return response()->json($products);
    }

    public function AddProduct(Request $request)
    {

        


        $request->validate([
            'name' => 'required',
            'description' => 'required|string',
            'price' => 'required|integer|min:1',
        ]);


        try {

            $products =  $this->service->AddProduct($request->name, $request->description, $request->price);

            return response()->json($products);
        } catch (\Throwable $th) {

            throw $th;
        }
    }


    public function  UpdateProduct(Request $request, $id)
    {


        try {
            $products =  $this->service->UpdateProduct($id, $request->name, $request->description, $request->price);

            return response()->json($products);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
