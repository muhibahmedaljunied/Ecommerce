<?php

namespace App\Http\Controllers;

use App\Services\FilterService;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Country;
use App\Models\Size;
use App\Models\Color;
use App\Models\Brand;
use App\Models\Age;
use App\Models\Attribute;
use App\Models\AttributeFamily;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeOption;
use App\Models\ProductAttributeValue;
use App\Models\ProductFilterableAttribute;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{






    public function show(Request $request, FilterService $filter)
    {


        $product = Product::where(function ($query) use ($request) {
            return $query->where('parent_id', '=', $request->id)
                ->orWhere('id', '=', $request->id)->where('status', '=', 'false');
        })
            ->with([
                'children' => function ($query) {


                    $query->join('product_attributes', 'product_attributes.product_id', '=', 'products.id');

                    $query->select('*');
                },
                'product_attribute' => function ($query) {
                    $query->select('*');
                }
            ])
            ->get();

        $filter->filter(collect($product)->toArray());

        return response()->json($filter->data);
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
        $category = Category::all();
        $country = Country::all();
        $size = Size::all();
        $color = Color::all();
        $brand = Brand::all();
        $age = Age::all();
        $product = Product::where('status', 'true')->get();


        // dd($product);

        return response()->json([
            'category' => $category,
            'country' => $country,
            'size' => $size,
            'color' => $color,
            'brand' => $brand,
            'age' => $age,
            'product' => $product,
        ]);
    }

    public function store_category(Request $request)
    {

        $product = new Product();
        $product->text = $request->post('product');
        if ($request->post('parent') != 0) {

            $product->parent_id = $request->post('parent');
        }
        $product->status = $request->post('status');
        $product->save();




        foreach ($request['items'] as $value) {

            $PFA = new ProductFilterableAttribute();
            $PFA->product_id = $product->id;
            $PFA->attribute_id = $value;
            $PFA->save();
        }
    }
    public function store(Request $request)
    {

        // dd($request['attribute'][0][0]);
        // foreach ($request['attribute'] as $value) {

        //     dd($value);
        // }

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

            if ($request->post('status') == 'false') {

                $file = $request->file('image');
                $upload_path = public_path('assets/upload');
                $file_name = $file->getClientOriginalName();
                $generated_new_name = time() . '.' . $file->getClientOriginalExtension();
                $file->move($upload_path, $generated_new_name);
                // --------------------------------------------------------------------------------------

                foreach ($request['attribute'] as $value) {

                    dd($value);
                }

                $product_attribute = new ProductAttributeOption();
                $product_attribute->product_id = $product->id;
                $product_attribute->attribute_option_id = $product->id;
                $product_attribute->qty = $request->post('qty');
                $product_attribute->price = $request->post('price');
                $product_attribute->discount = $request->post('discount');
                $product_attribute->image = $generated_new_name;
                $product_attribute->save();
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


    public function edit($id)
    {

        $product = Product::find($id);
        $category = Category::all();
        $country = Country::all();
        $size = Size::all();
        $brand = Brand::all();
        $color = Color::all();
        $age = Age::all();

        return response()->json([
            'product' => $product,
            'category' => $category,
            'country' => $country,
            'size' => $size,
            'brand' => $brand,
            'color' => $color,
            'age' => $age

        ]);
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
