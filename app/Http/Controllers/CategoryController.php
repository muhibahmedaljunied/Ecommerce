<?php

namespace App\Http\Controllers;

use App\category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    public function store(Request $request)
    {

        $category = new Category();
        $category->name = $request->post('name');
        $category->status = 'true';
        $category->save();
        return response()->json();
        
    }


    public function show(category $category)
    {

    }

 
    public function edit($id)
    {   

        $category = Category::find($id);
        return response()->json($category);

    }

 
    public function update(Request $request)
    {
        
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'status' => '',
        ]);
        $category = Category::find($request->id);
        $category->update($request->post());
        return response()->json($request);

    }

   
    public function destroy($id)
    {
        $Category = Category::find($id);

        $Category->delete();

        return response()->json('successfully deleted');
    }
}
