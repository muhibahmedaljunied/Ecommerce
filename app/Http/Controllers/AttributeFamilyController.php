<?php

namespace App\Http\Controllers;
use App\Models\AttributeFamily;
use App\Models\AttributeFamilyMapping;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeFamilyController extends Controller
{

    public function index(Request $request)
    {
        // Get all attributes.
        $attributes = Attribute::all();

        // Return a JSON response with the attributes.
        return response()->json([
            'attributes' => $attributes,

        ]);

    }


    public function get_attribute()
    {
        // Get all attributes.
        $attributes = Attribute::all();

        // Return a JSON response with the attributes.
        return response()->json([
            'attributes' => $attributes,

        ]);

    }




    public function store(Request $request)
    {

        // dd($request->all());
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
