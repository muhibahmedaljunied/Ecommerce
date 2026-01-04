<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductFamilyAttribute;
use App\Models\FamilyAttributeOption;

class ProductService
{

    public $count;
    public $data;
    public $request;
    public $product;
    public $arrayName;
    public $product_attribute;

    /**
     * Parse attribute options from data.
     *
     * @return void
     */
    public function get_attribute_option()
    {
        $this->arrayName = array();
        foreach ($this->count as $value) {
            foreach ($this->data[$value - 1] as $key => $value2) {
                $arrayName['fam'][$value - 1][$key]  = $value2[0];
                $arrayName['att'][$value - 1][$key]  = [$value2[1]];
            }
        }

        $this->arrayName = $arrayName;
    }

    /**
     * Save the product.
     *
     * @return void
     */
    public function save_product()
    {

        $product = new Product();
        $product->name = $this->request['product'];
        if ($this->request['parent'] != 0) {

            $product->parent_id = $this->request['parent'];
        }
        $product->status = $this->request['status'];
        $product->save();

        $this->product = $product;
    }


    /**
     * Save product family attribute and handle image upload.
     *
     * @param  array|null  $image
     * @param  int  $value
     * @return void
     */
    public function save_product_family_attribute($image, $value)
    {
        $generated_new_name = null;
        if ($image != null) {
            $file = $image[$value];
            $upload_path = base_path('assets/upload');
            $generated_new_name = time() . rand() . '.' . $file->getClientOriginalExtension();
            $file->move($upload_path, $generated_new_name);
        }

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
    }


    /**
     * Save family attribute options.
     *
     * @param  int  $value
     * @return void
     */
    public function save_family_attribute_option($value)
    {
        foreach ($this->arrayName['att'][$value] as $value2) {
            $attribute_option = new FamilyAttributeOption();
            $attribute_option->attribute_family_mapping_id = $this->arrayName['fam'][$value][$value];
            $attribute_option->product_family_attribute_id = $this->product_attribute->id;
            $attribute_option->attribute_option_id = $value2[0];
            $attribute_option->save();
        }
    }
}
