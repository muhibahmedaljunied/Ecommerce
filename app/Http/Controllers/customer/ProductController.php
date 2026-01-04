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

    public $filter;
    public $request;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services\FilterService  $filter
     * @return void
     */
    public function __construct(Request $request, FilterService $filter)
    {

        $this->request = $request;
        $this->filter = $filter;

    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Filter products based on request data.
     *
     * @param  \App\Services\FilterService  $filter
     * @return \Illuminate\Http\Response
     */
    public function filter(FilterService $filter)
    {


        // dd($this->request->all());
        $filter->product_id =  $this->request->post('array_id');
        $filter->array_data =  $this->request->post('data_fliter');

        $filter->wherefilter()->queryfilter($this->request['type']);

        // dd($filter->data);
        return response()->json([
            'products' => $filter->data,
        ]);
    }

    /**
     * Filter products by category.
     *
     * @param  \App\Services\FilterService  $filter
     * @return \Illuminate\Http\Response
     */
    public function category_filter(FilterService $filter)
    {



        $filter->product_id =  $this->request->id;
        $filter->queryfilter($this->request['type']);


        return response()->json([
            'products' => $filter->data,
        ]);

    }





    /**
     * Filter products by price.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Get detailed information for a specific product family attribute.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProductDetails($id)
    {

        $product = ProductFamilyAttribute::where(function ($query) use ($id) {
            return $query->where('id', '=', $id);
        })
            ->with(
                [
                    'product' => function ($query) {
                        $query->where('status', 'false');
                        $query->select('*');
                    }
                ]

            )->with(
                ['family_attribute_option' => function ($query) {
                    $query->with(['attribute_option' => function ($query) {

                        $query->with(['attribute' => function ($query) {

                            $query->select('attributes.*');
                        }]);

                        $query->select('attribute_options.*');
                    }]);
                    $query->select('family_attribute_options.*');
                }]

            )
            ->get();


        return response()->json($product);
    }

    /**
     * Get all featured products.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFeaturedProducts()
    {

        $featuredProduct = DB::table('products')
            ->join('product_family_attributes', 'product_family_attributes.product_id', '=', 'products.id')
            ->where('product_family_attributes.featured', '=', 'yes')
            ->select('products.*', 'product_family_attributes.*')
            ->get();
            // dd($featuredProduct);
        return response()->json($featuredProduct);
    }

    /**
     * Get all new products.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNewProducts()
    {

        $newProduct = DB::table('products')
            ->join('product_family_attributes', 'product_family_attributes.product_id', '=', 'products.id')
            ->where('product_family_attributes.new', '=', 'yes')
            ->select('products.*', 'product_family_attributes.*')
            ->get();
        return response()->json($newProduct);
    }
}
