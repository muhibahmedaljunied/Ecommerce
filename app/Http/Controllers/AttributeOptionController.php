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

  


    // public function store(Request $request)
    // {

    //     $attribute = new Attribute();
    //     $attribute->name = $request->post('name');
    //     $attribute->code = $request->post('code');
    //     $attribute->save();

    //     foreach ($request['items'] as $value) {

    //         $PFA = new AttributeOption();
    //         $PFA->attribute_id = $attribute->id;
    //         $PFA->attribute_id = $value;
    //         $PFA->save();
    //     }


   

    //     return response()->json();
        
    // }
    
}
