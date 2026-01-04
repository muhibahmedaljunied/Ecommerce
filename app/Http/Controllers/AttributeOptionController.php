<?php

namespace App\Http\Controllers;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Illuminate\Http\Request;

class AttributeOptionController extends Controller
{

    public function index(Request $request)
    {
        // Retrieve all attributes that do not have a parent.
        $category = Attribute::where('parent_id',null)->select()->get();
        // Return the retrieved attributes as a JSON response.
        return response()->json($category);

        // return response()->json(Category::all());
    }





}
