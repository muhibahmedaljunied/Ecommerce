<?php

namespace App\Http\Controllers;

use App\Models\AttributeOption;
use App\Models\Attribute;
use App\Models\AttributeFamily;
use Facade\Ignition\Tabs\Tab;
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

        $attributes = AttributeFamily::where('id', $request->id)
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

        $count_attributes =  DB::table('attribute_family_mappings')
            ->where('attribute_family_id', $request->id)
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

        // dd($request['count']);


        try {
            DB::beginTransaction(); // Tell Laravel all the code beneath this is a transaction

            $attribute = new Attribute();
            $attribute->name = $request->post('name');
            $attribute->code = $request->post('code');
            $attribute->save();


            foreach ($request['count'] as $value) {

                // dd($request->post('value')[$value]);

                $attribute_option = new AttributeOption();
                $attribute_option->attribute_id = $attribute->id;
                if (isset($request->post('code_value')[$value])) {

                    $attribute_option->code = $request->post('code_value')[$value];
                }
                $attribute_option->value = $request->post('value')[$value];
                $attribute_option->save();
            }



            DB::commit(); // Tell Laravel this transacion's all good and it can persist to DB


            return response([
                'message' => "attribute created successfully",
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

    public function edit(Request $request)
    {

        // dd($request->id);





    }
    public function update(Request $request)
    {

        // dd($request->id);



        try {
            DB::beginTransaction(); // Tell Laravel all the code beneath this is a transaction

            Attribute::where([
                'id' => $request->id,

            ])
                ->update([

                    'name' => $request->post('name'),
                    'code' => $request->post('code'),
                ]);


            // ------------------------------------------------------------------------

            foreach ($request['count'] as $value) {

                AttributeOption::where([
                    'attribute_id' => $request->id,

                ])
                    ->updateOrCreate(
                        [
                            'attribute_id' => $request->id,
                            'code' => $request->post('code_value')[$value],
                            'value' => $request->post('value')[$value],
                        ]

                    );
            }



            DB::commit(); // Tell Laravel this transacion's all good and it can persist to DB


            return response([
                'message' => "attribute updated successfully",
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
