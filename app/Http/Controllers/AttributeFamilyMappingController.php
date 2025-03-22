<?php

namespace App\Http\Controllers;

use App\Models\AttributeFamily;
use App\Models\AttributeFamilyMapping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


    public function update(Request $request)
    {



        try {
            DB::beginTransaction(); // Tell Laravel all the code beneath this is a transaction



            AttributeFamily::where([
                'id' => $request->id,

            ])
                ->update([

                    'name' => $request->post('name'),
                    'code' => $request->post('code'),
                ]);


            // ---------------------------------------------------------------



            foreach ($request['item'] as $value) {

                AttributeFamilyMapping::where([
                    'attribute_family_id' => $request->id,

                ])
                    ->updateOrCreate(
                        [
                            'attribute_family_id' => $request->id,
                            'attribute_id' => $value,
                        ]

                    );
            }

            DB::commit(); // Tell Laravel this transacion's all good and it can persist to DB


            return response([
                'message' => "attribute_family updated successfully",
                'status' => "success"
            ], 200);
        } catch (\Exception $exp) {

            DB::rollBack(); // Tell Laravel, "It's not you, it's me. Please don't persist to DB"


            return response([
                'message' => $exp->getMessage(),
                'status' => 'failed'
            ], 400);
        }
    }
}
