<?php

namespace App\Services;

use App\Models\Product;

class FilterService
{

    public $link;
    public  $product_id;
    public $array_data;
    public $array_where = array();
    public $data = [
        [
            "id" => 0,
            "text" => 0,
            "rank" => 0,
            "status" => 0,
            "parent_id" => 0,
        ]

    ];
    public $count = 0;

    function wherefilter()
    {


        $i = 0;
        $i1 = 0;
        foreach ($this->array_data as $key => $value) {


            foreach ($value as $key2 => $value2) {



                if ($value2 == 'true') {

                    $this->array_where[$i1] = $key2;
                }

                $i1 = $i1 + 1;
            }


            $i = $i + 1;
        }

        return $this;
    }

    function filter()
    {



        // dd($this->data);
        $attribute = 0;
        foreach ($this->link as $value) {

            if (array_key_exists('children', $value)) {


                if ($value['children'] == null) {

                    if (array_key_exists('product_family_attribute', $value)) {


                        foreach ($value['product_family_attribute'] as $key2 => $value2) {

                            if (array_key_exists('family_attribute_option', $value2)) {

                                foreach ($value2['family_attribute_option'] as $value3) {

                                    if ($value3['attribute_option'] != null && $attribute == 0) {

                                        $attribute = 1;
                                    }
                                }


                                if ($attribute == 0) {

                                    unset($value['product_family_attribute'][$key2]);
                                   
                                }
                            }

                            $attribute = 0;
                        }

                        $this->data[$this->count] = $value;
                        $this->count = $this->count + 1;
                    } else {

                        if ($value['status'] == 'false') {

                            $this->data[$this->count] = $value;
                            $this->count = $this->count + 1;
                        }
                    }
                } else {

                    $this->filter($value['children']);
                }
            } else {


                $this->data[$this->count] = $value;
                $this->count = $this->count + 1;
            }
        }

        // dd($this->data);
    }

    function queryfilter($type)
    {


        ($type == 'product') ? $this->productfilter() : $this->attributefilter();

        return $this;
    }

    function productfilter()
    {

        $product = Product::where(function ($query) {
            return $query->where('parent_id', '=', $this->product_id)
                ->orWhere('id', '=', $this->product_id)->where('status', '=', 'false');
        })
            ->with([
                'children' => function ($query) {

                    $query->select('*');
                },
                'product_family_attribute' => function ($query) {
                    $query->select('*');
                }
            ])
            ->get();

        $this->link = collect($product)->toArray();

    }

    function attributefilter()
    {



        $product = Product::where(function ($query) {
            return $query->where('parent_id', '=', $this->product_id['product_id'])
                ->orWhere('id', '=', $this->product_id['product_id'])->where('status', '=', 'false');
        })
            ->with('children')
            ->with('product_family_attribute.family_attribute_option.attribute_option', function ($query) {

                $query->whereIn('value', $this->array_where);
            })
            ->get();

        $this->link = collect($product)->toArray();
    }
}

  
