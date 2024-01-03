<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;


    public function attribute_family_mapping()
    {
        return $this->hasMany(AttributeFamilyMapping::class);
    }


    public function attribute_option()
    {
        return $this->hasMany(AttributeOption::class);
    }
    public function product_filterable_attribute()
    {
        return $this->hasMany(ProductFilterableAttribute::class);
    }
    

}
