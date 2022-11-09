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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
                // $this->middleware('Admin');

        
    }
    public function index(Request $request)
    {
        if($request->id){ //this for show products in customer

            $product = Product::where('category_id', $request->id)
            ->join('categories','products.category_id', '=', 'categories.id')
            ->join('countries','products.country_id', '=', 'countries.id')
            ->join('sizes','products.size_id', '=', 'sizes.id')
            ->select('products.*','categories.name as category_name','countries.name as country_name','sizes.name as size_name')
            ->get();
            return response()->json($product);
        }else{ //this for show products in admin
            $product = DB::table('products')
            ->join('categories','products.category_id', '=', 'categories.id')
            ->join('countries','products.country_id', '=', 'countries.id')
            ->join('sizes','products.size_id', '=', 'sizes.id')
            ->select('products.*','categories.name as category_name','countries.name as country_name','sizes.name as size_name')
            ->get();
            return response()->json($product);
        }
    }
// -------------------------------------------------------------------
    public function getProductDetails($id){
        $Product = DB::table('products')
                    ->join('categories','products.category_id', '=', 'categories.id')
                    ->where('products.id','=', $id)
                    ->select('products.*','categories.name as category_name')
                    ->first();
        
        //$data = $Product->toArray();
        //var_dump($Product);
        return response()->json($Product);
    }

// ---------------------------------------------------------------------
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $country = Country::all();
        $size = Size::all();

        return response()->json(['category'=>$category,'country'=>$country,'size'=>$size]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $file = $request->file('image');
        // $upload_path = public_path('assets/upload');
        // $file_name = $file->getClientOriginalName();
        // $generated_new_name = time() . '.' . $file->getClientOriginalExtension();
        // $file->move($upload_path, $generated_new_name);

        $product = new Product();
        $product->name=$request->post('product');
        $product->category_id= $request->post('category');
        $product->country_id= $request->post('country');
        $product->size_id= $request->post('size');
        $product->qty= $request->post('qty');
        $product->price= $request->post('price');
        $product->discount= $request->post('discount');
        $product->status = $request->post('status');
        // $product->image = $file_name;
        $product->save();
        return response()->json($request->file('image'));

        // ------------------------------------------------------------
   

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
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
        return response()->json(['product'=>$product,'category'=>$category,'country'=>$country,'size'=>$size]);
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
