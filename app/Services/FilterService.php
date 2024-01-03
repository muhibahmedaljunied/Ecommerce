<?php

namespace App\Services;
use App\Models\Product;
class FilterService
{

    public $product;
    public $array_data;
    public $array_where = array();
    public $data = [];
    public $count = 0;
    function filter($link)
    {


        // $link = collect($this->product)->toArray();

   
        foreach ($link as $value) {

            if (array_key_exists('children', $value)) {

                
                if ($value['children'] == null) {

                    if (array_key_exists('product_family_attribute', $value)) {

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
    }


    function wherefilter()
    {


        $i=0;
        foreach ($this->array_data as $key => $value) {


            if ($this->array_data[$key] != 0) {

                $this->array_where= ['product_attributes.'.$key => $value];
            }

            $i = $i+1;
        }
        return $this; 

    }

    function queryfilter(){
        

        $this->product = Product::where(function ($query){
            return $query->where('parent_id', '=', $this->array_data['product_id'])
                ->orWhere('id', '=', $this->array_data['product_id'])->where('status', '=', 'false');
        })->with([
            'children' => function ($query){

                $query->join('product_attributes', 'product_attributes.product_id', '=', 'products.id');
                $query->where($this->array_where);
                $query->select('*');
            },
            'product_attribute' => function ($query){

                $query->where($this->array_where);
                $query->select('*');
                
            }
        ])
            ->get();

            return $this;
    }
}




