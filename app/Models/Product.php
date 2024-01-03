<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = [
        'name',
        'qty',
        'price',
        'discount',
        'image',
        'status'
    ];


    public function children(){


        return $this->hasMany('App\Models\Product', 'parent_id','id')->with('children');


    }

    public function product_family_attribute()
    {
        return $this->hasMany(ProductFamilyAttribute::class);
    }

    public function product_filterable_attribute()
    {
        return $this->hasMany(ProductFilterableAttribute::class);
    }

    
}
