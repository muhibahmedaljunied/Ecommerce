<?php

namespace App\Http\Controllers\Customer;

use App\Services\FilterService;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductFamilyAttribute;
use Illuminate\Http\Request;

use DB;

class ProductController extends Controller
{

    public $array_data;
    public function __construct(Request $request)
    {
        
       $this->array_data =  $request->post('array_id');
    }
    public function index(Request $request)
    {


        $product = Product::where('product_id', $request->id)
            ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
            ->join('countries', 'product_attributes.country_id', '=', 'countries.id')
            ->join('sizes', 'product_attributes.size_id', '=', 'sizes.id')
            ->select(
                'products.*',
                'product_attributes.*',
                'countries.name as country_name',
                'sizes.name as size_name'
            )
            ->get();
        return response()->json($product);
    }
 
    public function filter(Request $request, FilterService $filter){

        
        $filter->wherefilter()->queryfilter()->filter();
        return response()->json($filter->data);

    }
    public function category_filter(Request $request, FilterService $filter)
    {


        $product = Product::where('id', $request->id)
      
        ->select(
            'products.*',
      
        )
        ->get();

        $product = Product::where(function ($query) use ($request) {
            return $query->where('parent_id', '=', $request->id)
                ->orWhere('id', '=', $request->id)->where('status', '=', 'false');
        })
            ->with([
                'children' => function ($query) {


                    $query->join('product_family_attributes', 'product_family_attributes.product_id', '=', 'products.id');

                    $query->select('*');
                },
                'product_family_attribute' => function ($query) {
                    $query->select('*');
                }
            ])
            ->get();

        $filter->filter(collect($product)->toArray());
        // return response()->json([
        //     'trees' => $filter->dat,
        //     'category_attribute_filter' => $last_nodes
        // ]);

        return response()->json($filter->data);
    }


 
    // public function country_filter(FilterService $filter)
    // {

    //     $filter->wherefilter()->queryfilter()->filter();
    //     return response()->json($filter->data);
    // }


    // public function size_filter(FilterService $filter)
    // {

    //     $filter->wherefilter()->queryfilter()->filter();

    //     return response()->json($filter->data);
    // }
    // // ---------------------------------------------------
    // public function color_filter(FilterService $filter)
    // {

    //     $filter->wherefilter()->queryfilter()->filter();
    //     return response()->json($filter->data);
    // }
    // // -------------------------------------------------------------------
    // public function material_filter(FilterService $filter)
    // {

    //     $filter->wherefilter()->queryfilter()->filter();
    //     return response()->json($filter->data);
    // }
    // // -------------------------------------------------------------------
    // public function gender_filter(FilterService $filter)
    // {

    //     $filter->wherefilter()->queryfilter()->filter();
    //     return response()->json($filter->data);
    // }
    // -------------------------------------------------------------------
    public function product_by_price(Request $request)
    {
        // $array_id = [];
        // foreach ($request->post('array_id') as $key => $value) {

        //     $array_id[$key] = $value;
        // }
        // $all = [];
        // $all = $this->all_condition($array_id);

        $data = Product::where('price', $request->id)
            ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
            ->join('countries', 'product_attributes.country_id', '=', 'countries.id')
            ->join('sizes', 'product_attributes.size_id', '=', 'sizes.id')
            ->select(
                'products.*',
                'product_attributes.*',
                'countries.name as country_name',
                'sizes.name as size_name'
            )
            ->get();
        return response()->json($data);
    }
    public function getProductDetails($id)
    {
        
        // $Product = DB::table('products')
        //     ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
        //     ->where('products.id', '=', $id)
        //     ->select(
        //         'products.*',
        //         'product_attributes.*',
        //     )
        //     ->first();
        $product = ProductFamilyAttribute::where(function ($query) use ($id) {
            return $query->where('id', '=',$id);
        })
            ->with([
                'product' => function ($query){
                    $query->where('status','false');
                    $query->select('*');
            
                }
            ]
                
            )->with(['family_attribute_option'=> function ($query){
                $query->with(['attribute_option'=>function($query){

                    $query->with(['attribute'=>function($query){

                        $query->select('attributes.*');
    
                    }]);

                    $query->select('attribute_options.*');

                }]);
                // $query->with('attribute');
                $query->select('family_attribute_options.*');
            }]
                
            )
            ->get();


        //$data = $Product->toArray();
        //var_dump($Product);
        return response()->json($product);
    }

    public function getFeaturedProducts()
    {
        // $featuredProduct = Product::where('status', 2)
        //     ->limit(3)
        //     ->get();

        $featuredProduct = DB::table('products')
            ->join('product_family_attributes', 'product_family_attributes.product_id', '=', 'products.id')
            ->where('product_family_attributes.featured', '=', 'yes')
            ->select('products.*', 'product_family_attributes.*')
            ->get();
        // ->limit(3);



        return response()->json($featuredProduct);
    }

    public function getNewProducts()
    {
        // $newProduct = Product::where('status', 1)
        //     ->orderBy('id', 'desc')
        //     ->limit(8)
        //     ->get();


        $newProduct = DB::table('products')
            ->join('product_family_attributes', 'product_family_attributes.product_id', '=', 'products.id')
            ->where('product_family_attributes.new', '=', 'yes')
            ->select('products.*', 'product_family_attributes.*')
            ->get();
        // ->limit(3);


        //return $featuredProduct;
        return response()->json($newProduct);
    }



}
