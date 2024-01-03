<?php

namespace App\Http\Controllers;
use App\Models\AttributeOption;
use App\Models\Attribute;
use App\Models\AttributeFamily;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AttributeController extends Controller
{

    public function index(Request $request)
    {


        $attributes = Attribute::with([
            'attribute_option' => function ($query) {

                $query->select('*');
            }
        ])->get();

        return response()->json([
            'attributes' => $attributes,

        ]);



    }

    public function get_attribute(Request $request)
    {

         $attributes = AttributeFamily::where('id',$request->id)
            ->with([
                'attribute_family_mapping' => function ($query) {

                    $query->select('*');
                    // $query->withCount('attribute_family_mappings');
                },
                'attribute_family_mapping.attribute' => function ($query) {

                    $query->select('*');
                },
                'attribute_family_mapping.attribute.attribute_option' => function ($query) {

                    $query->select('*');
                }
            ])->get();

           $count_attributes =  DB::table('attribute_family_mappings')
           ->where('attribute_family_id',$request->id)
           ->get()->count();

         
        return response()->json([
            'attributes' => $attributes,
            'count_attributes' => $count_attributes,


        ]);

        // return response()->json([
        //     'attributes' => Attribute::all(),

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
            $attribute_option->value = $request->post('value')[$value];
            $attribute_option->save();
        }




        return response()->json();
    }
}
