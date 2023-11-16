<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use DB;
class ProductController extends Controller
{

    public function index(Request $request)
    {


        $product = Product::where('category_id', $request->id)
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('countries', 'products.country_id', '=', 'countries.id')
            ->join('sizes', 'products.size_id', '=', 'sizes.id')
            ->select('products.*', 'categories.name as category_name', 'countries.name as country_name', 'sizes.name as size_name')
            ->get();
        return response()->json($product);
    }
    public function all_condition($data)
    {

        // return $data['category_id'];
        $all = array();
        if ($data['category_id'] != 0) {
            $s1 = ["category_id", $data['category_id']];
            $all[0] = $s1;
        }


        if ($data['country_id'] != 0) {

            $s2 = ["country_id", $data['country_id']];
            $all[1] = $s2;
        }


        if ($data['size_id'] != 0) {

            $s3 = ["size_id", $data['size_id']];
            $all[2] = $s3;
        }
        return $all;
    }
    public function category_filter(Request $request)
    {

      
        $array_id = [];
        foreach ($request->post('array_id') as $key => $value) {

            $array_id[$key] = $value;
        }
        $all = [];
        $all = $this->all_condition($array_id);
        $data = Product::where($all)
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('countries', 'products.country_id', '=', 'countries.id')
            ->join('sizes', 'products.size_id', '=', 'sizes.id')
            ->select('products.*', 'categories.name as category_name', 'countries.name as country_name', 'sizes.name as size_name')
            ->get();
        return response()->json($data);
    }

    public function country_filter(Request $request)
    {


        $array_id = [];
        foreach ($request->post('array_id') as $key => $value) {

            $array_id[$key] = $value;
        }
        $all = [];
        $all = $this->all_condition($array_id);

        $data = Product::where($all)
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('countries', 'products.country_id', '=', 'countries.id')
            ->join('sizes', 'products.size_id', '=', 'sizes.id')
            ->select('products.*', 'categories.name as category_name', 'countries.name as country_name', 'sizes.name as size_name')
            ->get();
        return response()->json($data);
    }

    public function size_filter(Request $request)
    {


        $array_id = [];
        foreach ($request->post('array_id') as $key => $value) {

            $array_id[$key] = $value;
        }
        $all = [];
        $all = $this->all_condition($array_id);
        $data = Product::where($all)
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('countries', 'products.country_id', '=', 'countries.id')
            ->join('sizes', 'products.size_id', '=', 'sizes.id')
            ->select('products.*', 'categories.name as category_name', 'countries.name as country_name', 'sizes.name as size_name')
            ->get();
        return response()->json($data);
    }

    // -------------------------------------------------------------------

    public function product_by_price(Request $request)
    {
        $array_id = [];
        foreach ($request->post('array_id') as $key => $value) {

            $array_id[$key] = $value;
        }
        $all = [];
        $all = $this->all_condition($array_id);

        $data = Product::where('price', $request->id)
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('countries', 'products.country_id', '=', 'countries.id')
            ->join('sizes', 'products.size_id', '=', 'sizes.id')
            ->select('products.*', 'categories.name as category_name', 'countries.name as country_name', 'sizes.name as size_name')
            ->get();
        return response()->json($data);
    }
    public function getProductDetails($id)
    {
        $Product = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('sizes', 'products.category_id', '=', 'categories.id')
            ->join('countries', 'products.category_id', '=', 'categories.id')
            ->where('products.id', '=', $id)
            ->select('products.*', 'categories.name as category_name', 'sizes.name as size_name', 'countries.name as country_name')
            ->first();

        //$data = $Product->toArray();
        //var_dump($Product);
        return response()->json($Product);
    }

    // ---------------------------------------------------------------------








}
