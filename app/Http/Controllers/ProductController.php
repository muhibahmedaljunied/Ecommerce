<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\FilterService;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeFamily;
use App\Models\FamilyAttributeOption;
use App\Models\ProductFilterableAttribute;
use App\Models\ProductFamilyAttribute;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public $request;
    public function __construct(Request $request)
    {

        $this->request = $request;
    }

    public function init_data($product_service)
    {

        $product_service->request = $this->request->all();
        $product_service->count = json_decode($this->request['count']);
        $product_service->data = json_decode($this->request['product_attr']);
    }

    public function index()
    {

        $product = Product::where(function ($query) {

            return $query->where('status', 'false');
        })
            ->with([
                'product_family_attribute.family_attribute_option' => function ($query) {

                    $query->join('attribute_options', 'family_attribute_options.attribute_option_id', '=', 'attribute_options.id');
                    $query->join('attributes', 'attributes.id', '=', 'attribute_options.attribute_id');
                    $query->select('*');
                },
            ])
            ->get();

        return response()->json(['product' => $product]);
    }
    public function show(Request $request, FilterService $filter)
    {

        // dd($request->id);
        $filter->product_id =  $request->id;
        $product_filterable_attributes = ProductFilterableAttribute::where(function ($query) use ($request) {
            return $query->where('product_filterable_attributes.product_id', '=', $request->id);
        })->with([
            'attribute.attribute_option' => function ($query) {
                $query->select('*');
            }
        ])
            ->get();
        // -----------------------------------------------------------------------------------------------
        $filter->queryfilter($request['type']);

        // $filter->queryfilter($request['type'])->filter();

        // dd($product_filterable_attributes);

        return response()->json([
            'products' => $filter->data,
            'product_filterable_attributes' => $product_filterable_attributes
        ]);

        // return response()->json($filter->data);
    }

    public function get_product_status(Request $request)
    {



        $products = Product::where('id', $request->id)->get();
        return response()->json(['product' => $products]);
    }




    public function tree_product(Request $request)
    {




        $products = Product::where('id', $request->id)->with('children')->get();

        $last_nodes = Product::where('parent_id', null)->select('products.*')->max('id');


        return response()->json([
            'trees' => $products,
            'last_nodes' => $last_nodes
        ]);
    }

    public function tree_product_admin(Request $request)
    {


        $products = Product::where('parent_id', null)->with('children')->get();

        $last_nodes = Product::where('parent_id', null)->select('products.*')->max('id');



        return response()->json([
            'trees' => $products,
            'last_nodes' => $last_nodes,
            'attribute_families' => AttributeFamily::all()

        ]);
    }


    public function get_attribute()
    {


        return response()->json([
            'attributes' => Attribute::all(),

        ]);
    }



    public function create()
    {

        $product = Product::where('status', 'true')->get();


        // dd($product);

        return response()->json([

            'product' => $product,
        ]);
    }

    public function store_category(Request $request)
    {


        dd($request->all());
        $product = new Product();
        $product->text = $request->post('product');
        if ($request->post('parent') != 0) {

            $product->parent_id = $request->post('parent');
        }
        $product->status = 'true';
        $product->save();

        foreach ($request->post('items') as $value) {

            $product_attribute = new ProductFilterableAttribute();
            $product_attribute->product_id = $product->id;
            $product_attribute->attribute_id = $value;
            $product_attribute->save();

        }
    }




    public function store(ProductService $product_service)
    {



        // dd($this->request->all());
        $this->init_data($product_service);
        // dd($product_service->data,$product_service->request,$product_service->count);
        try {
            DB::beginTransaction(); // Tell Laravel all the code beneath this is a transaction

            // dd($product_service->count);
            // --------------------------------------------------------------------------------------
            $product_service->save_product();
            // --------------------------------------------------------------------------------------
            $product_service->get_attribute_option();

            for ($value = 0; $value < count($product_service->count); $value++) {

                // dd(count($product_service->count),$value);
                // --------------------------------this save variant details of every product---------------
                $product_service->save_product_family_attribute($this->request->file('image'), $value);

                // -----------------------------------this save attributes of every product------------------
                $product_service->save_family_attribute_option($value);
            }



            dd(11);
            // dd(Product::all());
            // ------------------------------------------------------------------------------------------------------
            DB::commit(); // Tell Laravel this transacion's all good and it can persist to DB


            return response([
                'message' => "product created successfully",
                'status' => "success"
            ], 200);
        } catch (\Exception $exp) {

            DB::rollBack(); // Tell Laravel, "It's not you, it's me. Please don't persist to DB"


            return response([
                'message' => $exp->getMessage(),
                'status' => 'failed'
            ], 400);
        }


        return response()->json('success');
    }




    public function edit($id)
    {

        $product = Product::find($id);


        return response()->json([
            'product' => $product,


        ]);
    }


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
