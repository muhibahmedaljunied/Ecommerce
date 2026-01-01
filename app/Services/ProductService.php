<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductFamilyAttribute;
use App\Models\FamilyAttributeOption;

class ProductService
{

    public $kk = 0;
    public $arr_p = array();
    public $count;
    public $data;
    public $request;
    public $product;
    public $arrayName;
    public $product_attribute;


    public function get_attribute_option()
    {




        // foreach ($this->count as $value) {
        //     dd($value);
        // }


        $this->arrayName = array();
        foreach ($this->count as $value) {

            foreach ($this->data[$value - 1] as $key => $value2) {


                $arrayName['fam'][$value - 1][$key]  = $value2[0];
                $arrayName['att'][$value - 1][$key]  = [$value2[1]];


                // dd($arrayName['fam'][$value - 1][$key],$value2,$key);
            }
        }

        $this->arrayName = $arrayName;
    }
    public function save_product()
    {

        $product = new Product();
        $product->text = $this->request['product'];
        if ($this->request['parent'] != 0) {

            $product->parent_id = $this->request['parent'];
        }
        $product->status = $this->request['status'];
        $product->save();

        $this->product = $product;
    }


    public function save_product_family_attribute($image, $value)
    {


        $generated_new_name = null;
        if ($image != null) {


            $file = $image[$value];

            // dd($file);
            // $upload_path = public_path('assets/upload');
            $upload_path = base_path('assets/upload');
            // dd($upload_path);
            $generated_new_name = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move($upload_path, $generated_new_name);
        }
        // ---------------------------------------------------------------------
        // dd(json_decode($this->request['family_id']));
        $product_attribute = new ProductFamilyAttribute();
        $product_attribute->product_id = $this->product->id;
        $product_attribute->qty = json_decode($this->request['qty'])[$value];
        $product_attribute->price = json_decode($this->request['price'])[$value];
        $product_attribute->description = (json_decode($this->request['description'])) ? json_decode($this->request['description'])[$value] : null;
        $product_attribute->attribute_family_mapping_id = json_decode($this->request['family_id']);
        $product_attribute->discount = (json_decode($this->request['discount'])) ? json_decode($this->request['discount'])[$value] : 0;
        $product_attribute->new =  ($this->request['new']) ? $this->request['new'] : 'no';
        $product_attribute->featured = ($this->request['featured']) ? $this->request['featured'] : 'no';
        $product_attribute->image = $generated_new_name;
        $product_attribute->save();
        $this->product_attribute = $product_attribute;
        // dd(11);
        // $this->arr_p[$this->kk] = $generated_new_name;

    }


    public function save_family_attribute_option($value)
    {


        // dd(11);
        // dd($this->arrayName['att'],$this->arrayName['fam'],$this->arrayName['att'][$value],$this->arrayName['att'][$value][$value],$this->arrayName['att'][$value][$value + 1]);
        foreach ($this->arrayName['att'][$value] as $value2) {


            $attribute_option = new FamilyAttributeOption();
            $attribute_option->attribute_family_mapping_id = $this->arrayName['fam'][$value][$value];
            $attribute_option->product_family_attribute_id = $this->product_attribute->id;
            $attribute_option->attribute_option_id = $value2[0];
            $attribute_option->save();
        }
    }
}
