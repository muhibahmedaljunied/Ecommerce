<?php

namespace App\Http\Controllers\Customer;

use App\Services\FilterService;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use DB;

class ProductController extends Controller
{

    public function index(Request $request)
    {


        $product = Product::where('product_id', $request->id)
            ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
            ->join('countries', 'product_attributes.country_id', '=', 'countries.id')
            ->join('sizes', 'product_attributes.size_id', '=', 'sizes.id')
            ->select(
                'products.*',
                'product_attributes.*',
                'countries.name as country_name',
                'sizes.name as size_name'
            )
            ->get();
        return response()->json($product);
    }
    public function all_condition($data)
    {

        // return $data['category_id'];
        $all = array();
        if ($data['product_id'] != 0) {
            $s1 = ["product_id", $data['product_id']];
            $all[0] = $s1;
        }


        if ($data['country_id'] != 0) {

            $s2 = ["country_id", $data['country_id']];
            $all[1] = $s2;
        }


        if ($data['size_id'] != 0) {

            $s3 = ["size_id", $data['size_id']];
            $all[2] = $s3;
        }
        return $all;
    }
    // public function category_filter(Request $request)
    // {


    //     $array_id = [];
    //     foreach ($request->post('array_id') as $key => $value) {

    //         $array_id[$key] = $value;
    //     }
    //     $all = [];
    //     $all = $this->all_condition($array_id);
    //     $data = Product::where($all)
    //     ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
    //     ->join('countries', 'product_attributes.country_id', '=', 'countries.id')
    //     ->join('sizes', 'product_attributes.size_id', '=', 'sizes.id')
    //     ->select(
    //         'products.*',
    //         'product_attributes.*',
    //         'products.text as category_name',
    //         'countries.name as country_name',
    //         'sizes.name as size_name'
    //     )
    //         ->get();
    //     return response()->json($data);
    // }
    // public function category_filter(Request $request)
    // {



    //     $data = Product::where('products.id', $request->id)
    //         ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
    //         ->join('countries', 'product_attributes.country_id', '=', 'countries.id')
    //         ->join('sizes', 'product_attributes.size_id', '=', 'sizes.id')
    //         ->select(
    //             'products.*',
    //             'product_attributes.*',
    //             'products.text as category_name',
    //             'countries.name as country_name',
    //             'sizes.name as size_name'
    //         )
    //         ->get();



    //     return response()->json($data);
    // }

    // public function get_children($link)
    // {



    //     foreach ($link as $value) {

    //         if (array_key_exists('children', $value)) {

    //             if ($value['children'] == null) {

    //                 if (array_key_exists('product_attribute', $value)) {

    //                     $this->data[$this->count] = $value;
    //                     $this->count = $this->count + 1;

    //                 } else {

    //                     if ($value['status'] == 'false') {

    //                         $this->data[$this->count] = $value;
    //                         $this->count = $this->count + 1;
    //                     }
    //                 }
    //             } else {

    //                 $this->get_children($value['children']);
    //             }

    //         }else{


    //             $this->data[$this->count] = $value;
    //             $this->count = $this->count + 1;

    //         }

    //         // -----------------------------------------------------------------------------------------
    //         // if ($value['children'] == null) {

    //         //     if (array_key_exists('product_attribute', $value)) {

    //         //         $this->data[$this->count] = $value;
    //         //         $this->count = $this->count + 1;

    //         //     } else {

    //         //         if ($value['status'] == 'false') {

    //         //             $this->data[$this->count] = $value;
    //         //             $this->count = $this->count + 1;
    //         //         }
    //         //     }
    //         // } else {

    //         //     $this->get_children($value['children']);
    //         // }
    //     }

    // }
    public function category_filter(Request $request, FilterService $filter)
    {


        // $product = Product::where('products.id', $request->id)
        // ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
        // ->get();

        // $filter->filter(collect($product)->toArray());
        // $product = Product::where('parent_id', $request->id)

        $product = Product::where(function ($query) use ($request) {
            return $query->where('parent_id', '=', $request->id)
                ->orWhere('id', '=', $request->id)->where('status', '=', 'false');
        })
            ->with([
                'children' => function ($query) {


                    $query->join('product_attributes', 'product_attributes.product_id', '=', 'products.id');

                    $query->select('*');
                },
                'product_attribute' => function ($query) {
                    $query->select('*');
                }
            ])
            ->get();

        $filter->filter(collect($product)->toArray());

        return response()->json($filter->data);
    }


    // public function country_filter(Request $request)
    // {


    //     $array_id = [];
    //     foreach ($request->post('array_id') as $key => $value) {

    //         $array_id[$key] = $value;
    //     }
    //     $all = [];
    //     $all = $this->all_condition($array_id);

    //     $data = Product::where($all)
    //         ->join('categories', 'products.category_id', '=', 'categories.id')
    //         ->join('countries', 'products.country_id', '=', 'countries.id')
    //         ->join('sizes', 'products.size_id', '=', 'sizes.id')
    //         ->select('products.*', 'categories.name as category_name', 'countries.name as country_name', 'sizes.name as size_name')
    //         ->get();
    //     return response()->json($data);
    // }
    public function country_filter(Request $request, FilterService $filter)
    {

        $array_data = $request->post('array_id');
        // dd($array_data);
        $product = Product::where(function ($query) use ($array_data) {
            return $query->where('parent_id', '=', $array_data['product_id'])
                ->orWhere('id', '=', $array_data['product_id'])->where('status', '=', 'false');
        })
            // ->with(function ($query) use ($array_data) {

            //     return $query->with(
            //         [
            //             'children' => function ($query) use ($array_data) {

            //                 $query->join('product_attributes', 'product_attributes.product_id', '=', 'products.id');
            //                 $query->Where('product_attributes.size_id', $array_data['size_id']);
            //                 if ($array_data['country_id'] != 0) {

            //                     $query->Where('product_attributes.country_id', $array_data['country_id']);
            //                 }

            //                 $query->select('*');
            //             }
            //         ]
            //     )
            //         ->orWith(
            //             [
            //                 'product_attribute' => function ($query) use ($array_data) {

            //                     $query->Where('product_attributes.country_id', $array_data['country_id']);
            //                     if ($array_data['size_id'] != 0) {

            //                         $query->Where('product_attributes.size_id', $array_data['size_id']);
            //                     }

            //                     $query->select('*');
            //                 }
            //             ]
            //         );
            // })
            // --------------------------------------------------------------------------------------

            // ->with('children')
            // ->whereHas('children', function ($query) use ($array_data) {

            //     $query->join('product_attributes', 'product_attributes.product_id', '=', 'products.id');
            //     $query->Where('product_attributes.size_id', $array_data['size_id']);
            //     if ($array_data['size_id'] != 0) {

            //         $query->Where('product_attributes.size_id', $array_data['size_id']);
            //     }

            //     $query->select('*');
            // })
            // ->with('product_attributes')
            // ->whereHas('product_attributes', function ($query) use ($array_data) {

            //     $query->Where('product_attributes.country_id', $array_data['country_id']);
            //     if ($array_data['size_id'] != 0) {

            //         $query->Where('product_attributes.size_id', $array_data['size_id']);
            //     }

            //     $query->select('*');
            // })


            // --------------------------------------------------------------------------------------
            ->with([
                'children' => function ($query) use ($array_data) {

                    $query->join('product_attributes', 'product_attributes.product_id', '=', 'products.id');
                    $query->Where('product_attributes.size_id', $array_data['size_id']);
                    if ($array_data['size_id'] != 0) {

                        $query->Where('product_attributes.size_id', $array_data['size_id']);
                    }

                    $query->select('*');
                },
                'product_attribute' => function ($query) use ($array_data) {

                    $query->Where('product_attributes.country_id', $array_data['country_id']);
                    if ($array_data['size_id'] != 0) {

                        $query->Where('product_attributes.size_id', $array_data['size_id']);
                    }

                    $query->select('*');
                }
            ])
            ->get();


        $filter->filter(collect($product)->toArray());

        // dd($filter->data);
        return response()->json($filter->data);
        // ----------------------------------------------------------
        // $array_id = [];
        // foreach ($request->post('array_id') as $key => $value) {

        //     $array_id[$key] = $value;
        // }
        // $all = [];
        // $all = $this->all_condition($array_id);

        // $data = Product::where($all)
        //     ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
        //     ->join('countries', 'product_attributes.country_id', '=', 'countries.id')
        //     ->join('sizes', 'product_attributes.size_id', '=', 'sizes.id')
        //     ->select(
        //         'products.*',
        //         'product_attributes.*',
        //         'countries.name as country_name',
        //         'sizes.name as size_name'
        //     )
        //     ->get();
        // return response()->json($data);
    }


    public function size_filter(Request $request, FilterService $filter)
    {

        $array_data = $request->post('array_id');
        // dd($array_data);

        $product = Product::where(function ($query) use ($array_data) {
            return $query->where('parent_id', '=', $array_data['product_id'])
                ->orWhere('id', '=', $array_data['product_id'])->where('status', '=', 'false');
        })
            // ->with('children')
            // ->whereHas('children', function ($query) use ($array_data) {


            //     $query->join('product_attributes', 'product_attributes.product_id', '=', 'products.id');
            //     $query->Where('product_attributes.size_id', $array_data['size_id']);
            //     if ($array_data['country_id'] != 0) {

            //         $query->Where('product_attributes.country_id', $array_data['country_id']);
            //     }
            //     $query->select('*');
            // })
            // ->with('product_attributes')
            // ->whereHas('product_attributes', function ($query) use ($array_data) {

            //     $query->Where('product_attributes.country_id', $array_data['country_id']);
            //     if ($array_data['size_id'] != 0) {

            //         $query->Where('product_attributes.size_id', $array_data['size_id']);
            //     }

            //     $query->select('*');
            // })


            // --------------------------------------------------------------------------------------
            ->with([
                'children' => function ($query) use ($array_data) {

                    $query->join('product_attributes', 'product_attributes.product_id', '=', 'products.id');
                    $query->Where('product_attributes.size_id', $array_data['size_id']);
                    if ($array_data['country_id'] != 0) {

                        $query->Where('product_attributes.country_id', $array_data['country_id']);
                    }
                    $query->select('*');
                },
                'product_attribute' => function ($query) use ($array_data) {

                    $query->Where('product_attributes.size_id', $array_data['size_id']);
                    if ($array_data['country_id'] != 0) {

                        $query->Where('product_attributes.country_id', $array_data['country_id']);
                    }

                    $query->select('*');
                }
            ])
            ->get();

        $filter->filter(collect($product)->toArray());
        // dd($filter->data);
        return response()->json($filter->data);

        // ------------------------------------------------------------------------
        // $array_id = [];
        // foreach ($request->post('array_id') as $key => $value) {

        //     $array_id[$key] = $value;
        // }
        // $all = [];
        // $all = $this->all_condition($array_id);
        // // dd($data);
        // $data = Product::where($all)
        //     ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
        //     ->join('countries', 'product_attributes.country_id', '=', 'countries.id')
        //     ->join('sizes', 'product_attributes.size_id', '=', 'sizes.id')
        //     ->select(
        //         'products.*',
        //         'product_attributes.*',
        //         'countries.name as country_name',
        //         'sizes.name as size_name'
        //     )
        //     ->get();

        // return response()->json($data);
    }
    // ---------------------------------------------------
    public function color_filter(Request $request, FilterService $filter)
    {


        $array_data = $request->post('array_id');
        $product = Product::where(function ($query) use ($array_data) {
            return $query->where('parent_id', '=', $array_data['product_id'])
                ->orWhere('id', '=', 1)->where('status', '=', 'false');
        })
            ->with([
                'children' => function ($query) {


                    $query->join('product_attributes', 'product_attributes.product_id', '=', 'products.id');

                    $query->select('*');
                },
                'product_attribute' => function ($query) use ($array_data) {

                    $query->Where('product_attributes.size_id', $array_data['color_id']);
                    $query->select('*');
                }
            ])
            ->get();


        $filter->filter(collect($product)->toArray());

        return response()->json($filter->data);

        // $array_id = [];
        // foreach ($request->post('array_id') as $key => $value) {

        //     $array_id[$key] = $value;
        // }
        // $all = [];
        // $all = $this->all_condition($array_id);
        // $data = Product::where($all)
        //     ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
        //     ->join('countries', 'product_attributes.country_id', '=', 'countries.id')
        //     ->join('sizes', 'product_attributes.size_id', '=', 'sizes.id')
        //     ->select(
        //         'products.*',
        //         'product_attributes.*',
        //         'countries.name as country_name',
        //         'sizes.name as size_name'
        //     )
        //     ->get();
        // return response()->json($data);
    }
    // -------------------------------------------------------------------
    public function material_filter(Request $request)
    {


        $array_id = [];
        foreach ($request->post('array_id') as $key => $value) {

            $array_id[$key] = $value;
        }
        $all = [];
        $all = $this->all_condition($array_id);
        $data = Product::where($all)
            ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
            ->join('countries', 'product_attributes.country_id', '=', 'countries.id')
            ->join('sizes', 'product_attributes.size_id', '=', 'sizes.id')
            ->select(
                'products.*',
                'product_attributes.*',
                'countries.name as country_name',
                'sizes.name as size_name'
            )
            ->get();
        return response()->json($data);
    }
    // -------------------------------------------------------------------
    public function gender_filter(Request $request)
    {


        $array_id = [];
        foreach ($request->post('array_id') as $key => $value) {

            $array_id[$key] = $value;
        }
        $all = [];
        $all = $this->all_condition($array_id);
        $data = Product::where($all)
            ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
            ->join('countries', 'product_attributes.country_id', '=', 'countries.id')
            ->join('sizes', 'product_attributes.size_id', '=', 'sizes.id')
            ->select(
                'products.*',
                'product_attributes.*',
                'countries.name as country_name',
                'sizes.name as size_name'
            )
            ->get();
        return response()->json($data);
    }
    // -------------------------------------------------------------------
    public function product_by_price(Request $request)
    {
        // $array_id = [];
        // foreach ($request->post('array_id') as $key => $value) {

        //     $array_id[$key] = $value;
        // }
        // $all = [];
        // $all = $this->all_condition($array_id);

        $data = Product::where('price', $request->id)
            ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
            ->join('countries', 'product_attributes.country_id', '=', 'countries.id')
            ->join('sizes', 'product_attributes.size_id', '=', 'sizes.id')
            ->select(
                'products.*',
                'product_attributes.*',
                'countries.name as country_name',
                'sizes.name as size_name'
            )
            ->get();
        return response()->json($data);
    }
    public function getProductDetails($id)
    {
        $Product = DB::table('products')
            ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
            ->join('sizes', 'product_attributes.size_id', '=', 'sizes.id')
            ->join('countries', 'product_attributes.country_id', '=', 'countries.id')
            ->where('products.id', '=', $id)
            ->select(
                'products.*',
                'product_attributes.*',
                'sizes.name as size_name',
                'countries.name as country_name'
            )
            ->first();

        //$data = $Product->toArray();
        //var_dump($Product);
        return response()->json($Product);
    }

    public function getFeaturedProducts()
    {
        // $featuredProduct = Product::where('status', 2)
        //     ->limit(3)
        //     ->get();

        $featuredProduct = DB::table('products')
            ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
            ->where('product_attributes.featured', '=', 'yes')
            ->select('products.*', 'product_attributes.*')
            ->get();
        // ->limit(3);



        return response()->json($featuredProduct);
    }

    public function getNewProducts()
    {
        // $newProduct = Product::where('status', 1)
        //     ->orderBy('id', 'desc')
        //     ->limit(8)
        //     ->get();


        $newProduct = DB::table('products')
            ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
            ->where('product_attributes.new', '=', 'yes')
            ->select('products.*', 'product_attributes.*')
            ->get();
        // ->limit(3);


        //return $featuredProduct;
        return response()->json($newProduct);
    }

    // ---------------------------------------------------------------------








}
