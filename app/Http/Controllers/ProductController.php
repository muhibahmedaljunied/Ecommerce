<?php

namespace App\Http\Controllers;

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


        $product_filterable_attributes = ProductFilterableAttribute::where(function ($query) use ($request) {
            return $query->where('product_filterable_attributes.product_id', '=', $request->id);
          
        })->with(['attribute.attribute_option' => function ($query) {
                $query->select('*');
            }
        ])
        ->get();
// -----------------------------------------------------------------------------------------------
        $product = Product::where(function ($query) use ($request) {
            return $query->where('parent_id', '=', $request->id)
                ->orWhere('id', '=', $request->id)->where('status', '=', 'false');
        })
            ->with([
                'children' => function ($query) {

                    // $query->join('product_family_attributes', 'product_family_attributes.product_id', '=', 'products.id');
                    $query->select('*');
                },
                'product_family_attribute' => function ($query) {
                    $query->select('*');
                }
            ])
   
            ->get();

         $filter->link = collect($product)->toArray();

        
        $filter->filter();
        return response()->json([
            'products' => $filter->data,
            'product_filterable_attributes' => $product_filterable_attributes
        ]);
       
        // return response()->json($filter->data);
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
            'attributes' => Attribute::all(),
            'attribute_families' => AttributeFamily::all()

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


        // dd($request->all());
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
    public function store(Request $request)
    {
        // dd($request->all());
        $count = json_decode($request['count']);
        $data = json_decode($request['product_attr']);

        // dd($data);
        try {
            DB::beginTransaction(); // Tell Laravel all the code beneath this is a transaction

            $product = new Product();
            $product->text = $request->post('product');
            if ($request->post('parent') != 0) {

                $product->parent_id = $request->post('parent');
            }
            $product->status = $request->post('status');
            $product->save();
            // --------------------------------------------------------------------------------------

            $arrayName = array();
            foreach ($count as $value) {

                // dd($data);
                foreach ($data[$value - 1] as $key => $value2) {


                    $arrayName['fam'][$value - 1][$key]  = $value2[0];
                    $arrayName['att'][$value - 1][$key]  = [$value2[1]];
                }
            }


            // --------------------------------------------------------------------------------------

            if ($request->post('status') == 'false') {


                foreach ($count as $value) {



                    $file = $request->file('image')[$value - 1];
                    $upload_path = public_path('assets/upload');
                    $generated_new_name = time() . '.' . $file->getClientOriginalExtension();
                    $file->move($upload_path, $generated_new_name);
                    // ---------------------------------------------------------------------
                    $product_attribute = new ProductFamilyAttribute();
                    $product_attribute->product_id = $product->id;
                    $product_attribute->qty = json_decode($request['qty'])[$value - 1];
                    $product_attribute->price = json_decode($request['price'])[$value - 1];
                    $product_attribute->description = json_decode($request['description'])[$value - 1];
                    $product_attribute->discount = json_decode($request['description'])[$value - 1];
                    $product_attribute->image = $generated_new_name;
                    $product_attribute->save();
                    // ---------------------------------------------------------------------
                    foreach ($arrayName['att'][$value - 1] as $value2) {


                        $attribute_option = new FamilyAttributeOption();
                        $attribute_option->attribute_family_mapping_id = $arrayName['fam'][$value - 1][$value - 1];
                        $attribute_option->product_family_attribute_id = $product_attribute->id;
                        $attribute_option->attribute_option_id = $value2[0];
                        $attribute_option->save();
                    }
                }
            }


            // ------------------------------------------------------------------------------------------------------
            DB::commit(); // Tell Laravel this transacion's all good and it can persist to DB


            return response([
                'message' => "purchase created successfully",
                'status' => "success"
            ], 200);
        } catch (\Exception $exp) {

            DB::rollBack(); // Tell Laravel, "It's not you, it's me. Please don't persist to DB"


            return response([
                'message' => $exp->getMessage(),
                'status' => 'failed'
            ], 400);
        }


        return response()->json($request->file('image'));
    }


    // public function edit($id)
    // {

    //     $product = Product::find($id);


    //     return response()->json([
    //         'product' => $product,


    //     ]);
    // }

   
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
