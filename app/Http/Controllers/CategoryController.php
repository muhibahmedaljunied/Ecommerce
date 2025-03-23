<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductFilterableAttribute;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function index(Request $request)
    {

        $products = Product::where('parent_id', null)->select('*')->get();

        return response()->json($products);
    }



    public function create()
    {
        return response()->json('asd');
    }





    public function edit(Request $request)
    {



        $attributes = Product::with('product_filterable_attribute.attribute')
            ->Where('id', $request->id)
            ->select('products.*')
            ->get();


        return response()->json([
            'attributes' => $attributes,
            'all_attributes' => Attribute::all(),

        ]);
    }


    public function update(Request $request)
    {

        // $request->validate([
        //     'name' => 'required|unique:categories|max:255',
        //     'status' => '',
        // ]);

    }


    public function destroy($id)
    {
        $Category = Product::find($id);

        $Category->delete();

        return response()->json('successfully deleted');
    }
}
