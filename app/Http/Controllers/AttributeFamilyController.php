<?php

namespace App\Http\Controllers;
use App\Models\AttributeFamily;
use App\Models\AttributeFamilyMapping;
use Illuminate\Http\Request;

class AttributeFamilyController extends Controller
{
    
    public function index(Request $request)
    {      
       
    }

  


    public function store(Request $request)
    {

        $family = new AttributeFamily();
        $family->name = $request->post('name');
        $family->code = $request->post('code');
        $family->save();

        
        foreach ($request['items'] as $value) {

            $AFM = new AttributeFamilyMapping();
            $AFM->attribute_family_id = $family->id;
            $AFM->attribute_id = $value;
            $AFM->save();
        }


        return response()->json();
        
    }

}
