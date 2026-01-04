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
        // Retrieve all products that do not have a parent.
        $products = Product::where('parent_id', null)->select('*')->get();
        // Return the products as a JSON response.
        return response()->json($products);
    }



    function category_filter(Request $request)
    {

        // Filter products by parent_id and status.
        $product = Product::where(function ($query) use ($request) {

            return $query->where('parent_id', '=', $request->id)
                ->where('status', '=', 'true');
        })
            ->get();

        // Return the filtered products as a JSON response.
        return response()->json([
            'products' => $product,

        ]);
    }



    public function create()
    {
        // This method is not implemented.
        return response()->json('asd');
    }





    public function edit(Request $request)
    {


        // Eager load product_filterable_attribute.attribute relationship.
        $attributes = Product::with('product_filterable_attribute.attribute')
            ->Where('id', $request->id)
            ->select('products.*')
            ->get();

        // Return the product attributes and all attributes as a JSON response.
        return response()->json([
            'attributes' => $attributes,
            'all_attributes' => Attribute::all(),

        ]);
    }


    public function update(Request $request)
    {

        // This method is not implemented.
        // $request->validate([
        //     'name' => 'required|unique:categories|max:255',
        //     'status' => '',
        // ]);

    }


    public function destroy($id)
    {
        // Find the product by its ID.
        $Category = Product::find($id);
        // Delete the product.
        $Category->delete();
        // Return a success message.
        return response()->json('successfully deleted');
    }
}
