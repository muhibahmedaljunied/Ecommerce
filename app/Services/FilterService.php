<?php

namespace App\Services;

use App\Models\Product;

class FilterService
{
    public $array_where = [];
    public $array_attribute = [];
    public $group_array_attribute = [];
    public $count = 0;
    public  $product_id;
    public $array_data;
    public $root;
    public $link;


    public $data = [
        [
            "id" => 0,
            "text" => 0,
            "rank" => 0,
            "status" => 0,
            "parent_id" => 0,
        ]

    ];

    /**
     * Process the filter data to determine which attributes to filter by.
     *
     * @return $this
     */
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

    /**
     * Iterate through a list of items and apply the filter.
     *
     * @param  array  $link
     * @return void
     */
    public function foreach_root($link)
    {

        foreach ($link as $value) {

            $this->filter($value);
        }
    }

    /**
     * Filter a specific item or traverse its children.
     *
     * @param  array  $value
     * @return void
     */
    function filter($value)
    {


        if ($value['children'] == null) {

            $this->get_details($value);
        } else {
            $this->foreach_root($value['children']);
        }
    }

    /**
     * Execute the query to retrieve products and apply filters.
     *
     * @return $this
     */
    function queryfilter()
    {


        $product = Product::where(function ($query) {

            return $query->where('parent_id', '=', $this->product_id)
                ->orWhere('id', '=', $this->product_id)->where('status', '=', 'false');
        })
            ->with('children')
            ->get();

        $this->root = collect($product)->toArray();
        $this->foreach_root($this->root);
        return $this;

    }



    /**
     * Get details for a specific product and apply attribute filters if necessary.
     *
     * @param  array  $value
     * @return void
     */
    function get_details($value)
    {


        if ($value['status'] == 'false') {


            if (empty($this->array_where)) {


                $product = Collect(Product::where(function ($query) use ($value) {
                    return $query->where('id', '=', $value['id']);
                })
                    ->with('product_family_attribute')
                    ->get())->toArray();

                $this->data[$this->count] = $product[0];
                $this->count = $this->count + 1;
            } else {


                $product = Collect(Product::where(function ($query) use ($value) {
                    return $query->where('id', '=', $value['id']);
                })
                    ->with('product_family_attribute.family_attribute_option.attribute_option', function ($query) {

                        $query->whereIn('value', $this->array_where);
                    })
                    ->get())->toArray();


                $this->filter_by_attribute($product);
            }
        }
    }


    /**
     * Filter products based on specific attribute options.
     *
     * @param  array  $value1
     * @return void
     */
    function filter_by_attribute($value1)
    {
        foreach ($value1 as $value) {
            foreach ($value['product_family_attribute'] as $key3 => $value3) {
                $count = 0;

                foreach ($value3['family_attribute_option'] as $value4) {
                    if ($value4['attribute_option'] == null) {
                        $this->array_attribute[$count] = null;
                    } else {
                        $this->array_attribute[$count] = $value4['attribute_option']['value'];
                        $this->group_array_attribute[$key3] = $value4['attribute_option']['value'];
                    }

                    $count = $count + 1;
                }
                $diff = array_diff($this->array_where, $this->array_attribute);

                if (!empty($diff)) {
                    unset($value['product_family_attribute'][$key3]);
                }

                $this->array_attribute = [];
            }

            $this->data[$this->count] = $value;
            $this->count = $this->count + 1;
        }
    }
}
