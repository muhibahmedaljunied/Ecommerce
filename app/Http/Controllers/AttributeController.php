<?php

namespace App\Http\Controllers;

use App\Models\AttributeOption;
use App\Models\Attribute;
use App\Models\AttributeFamily;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{

    public function show(Request $request)
    {


        $attributes = AttributeFamily::where('id',$request->id)
            ->with([
                'attribute_family_mapping' => function ($query) {

                    $query->select('*');
                },
                'attribute_family_mapping.attribute' => function ($query) {

                    $query->select('*');
                },
                'attribute_family_mapping.attribute.attribute_option' => function ($query) {

                    $query->select('*');
                }
            ])->get();

        return response()->json([
            'attributes' => $attributes,

        ]);

        // $attributes = DB::table('attribute_family_mappings')
        // ->where('attribute_family_mappings.attribute_family_id',$request->id)
        // ->join('attribute_families', 'attribute_families.id', '=', 'attribute_family_mappings.attribute_family_id')
        // ->join('attributes', 'attributes.id', '=', 'attribute_family_mappings.attribute_id')
        // ->join('attribute_options', 'attribute_options.attribute_id', '=', 'attributes.id')
        // ->select('attributes.*','attribute_options.*')
        // ->get();

        // dd($attributes);
        // return response()->json([
        //     'attributes' => $attributes,

        // ]);


    }





    public function store(Request $request)
    {

        // dd($request->all());
        $attribute = new Attribute();
        $attribute->name = $request->post('name');
        $attribute->code = $request->post('code');
        $attribute->save();


        foreach ($request['count'] as $value) {

            $attribute_option = new AttributeOption();
            $attribute_option->attribute_id = $attribute->id;
            $attribute_option->code = $request->post('code_value')[$value];
            $attribute_option->name = $request->post('value')[$value];
            $attribute_option->save();
        }




        return response()->json();
    }
}
