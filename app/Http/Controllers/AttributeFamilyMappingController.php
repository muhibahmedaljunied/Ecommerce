<?php

namespace App\Http\Controllers;

use App\Models\AttributeFamily;
use App\Models\AttributeFamilyMapping;
use Illuminate\Http\Request;

class AttributeFamilyMappingController extends Controller
{

    public function index(Request $request)
    {


        $attribute_families = AttributeFamily::with([
            'attribute_family_mapping' => function ($query) {

                $query->select('*');
            },
            'attribute_family_mapping.attribute' => function ($query) {

                $query->select('*');
            }
        ])->get();

        return response()->json([
            'attribute_families' => $attribute_families,

        ]);
    }




    public function store(Request $request)
    {

        // dd($request->all());
        $family = new AttributeFamily();
        $family->name = $request->post('name');
        $family->code = $request->post('code');
        $family->save();


        foreach ($request['item'] as $value) {

            $AFM = new AttributeFamilyMapping();
            $AFM->attribute_family_id = $family->id;
            $AFM->attribute_id = $value;
            $AFM->save();
        }


        return response()->json();
    }
}
