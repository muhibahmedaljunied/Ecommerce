<?php

namespace App\Http\Controllers;
use App\Models\Attribute;
use App\Models\AttributeOption;
use Illuminate\Http\Request;

class AttributeOptionController extends Controller
{
    
    public function index(Request $request)
    {      
        $category = Attribute::where('parent_id',null)->select()->get();
        return response()->json($category);  

        // return response()->json(Category::all());  
    }

  


    
}
