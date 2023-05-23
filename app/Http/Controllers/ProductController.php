<?php

namespace App\Http\Controllers;

use App\Product;
use App\category;
use App\country;
use App\size;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
  
    public function __construct()
    {
        // $this->middleware('Admin');


    }
    public function index(Request $request)
    {

        // return response()->json($request->id);
        if ($request->id) { //this for show products in customer

            $product = Product::where('category_id', $request->id)
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('countries', 'products.country_id', '=', 'countries.id')
                ->join('sizes', 'products.size_id', '=', 'sizes.id')
                ->select('products.*', 'categories.name as category_name', 'countries.name as country_name', 'sizes.name as size_name')
                ->get();
            return response()->json($product);
        } else { //this for show products in admin
            $product = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('countries', 'products.country_id', '=', 'countries.id')
                ->join('sizes', 'products.size_id', '=', 'sizes.id')
                ->select('products.*', 'categories.name as category_name', 'countries.name as country_name', 'sizes.name as size_name')
                ->get();
            return response()->json($product);
        }
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
  
    public function create()
    {
        $category = Category::all();
        $country = Country::all();
        $size = Size::all();

        return response()->json(['category' => $category, 'country' => $country, 'size' => $size]);
    }

    
    public function store(Request $request)
    {

        $file = $request->file('image');
        $upload_path = public_path('assets/upload');
        $file_name = $file->getClientOriginalName();
        $generated_new_name = time() . '.' . $file->getClientOriginalExtension();
        $file->move($upload_path, $generated_new_name);

        $product = new Product();
        $product->name = $request->post('product');
        $product->category_id = $request->post('category');
        $product->country_id = $request->post('country');
        $product->size_id = $request->post('size');
        $product->qty = $request->post('qty');
        $product->price = $request->post('price');
        $product->discount = $request->post('discount');
        $product->status = $request->post('status');
        $product->image = $generated_new_name;
        $product->save();
        return response()->json($request->file('image'));

        // ------------------------------------------------------------


    }

  
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $product = Product::find($id);
        $category = Category::all();
        $country = Country::all();
        $size = Size::all();
        return response()->json(['product' => $product, 'category' => $category, 'country' => $country, 'size' => $size]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $product->update($request->post());
        return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Category = Product::find($id);

        $Category->delete();

        return response()->json('successfully deleted');
    }
}
