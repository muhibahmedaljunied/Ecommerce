<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class ProductController extends BaseController
{


    // public function index()
    // {
    //     $blogs = Product::all();
    //     return $this->sendResponse(ProductResource::collection($blogs), 'Posts fetched.');
    // }


    public function index(Request $request)
    {

        $product = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('countries', 'products.country_id', '=', 'countries.id')
            ->join('sizes', 'products.size_id', '=', 'sizes.id')
            ->select('products.*', 'categories.name as category_name', 'countries.name as country_name', 'sizes.name as size_name')
            ->get();
        return response()->json($product);
    }

    public function show(Request $request)
    {


        $product = DB::table('products')->where('id', $request->id)
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('countries', 'products.country_id', '=', 'countries.id')
            ->join('sizes', 'products.size_id', '=', 'sizes.id')
            ->select('products.*', 'categories.name as category_name', 'countries.name as country_name', 'sizes.name as size_name')
            ->get();
        return response()->json($product);
    }
}
