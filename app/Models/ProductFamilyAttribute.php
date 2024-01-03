<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFamilyAttribute extends Model
{
    use HasFactory;


    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    
    // public function attribute_family_mapping()
    // {
    //     return $this->belongsTo(AttributeFamilyMapping::class);
    // }



    public function family_attribute_option()
    {
        return $this->hasMany(FamilyAttributeOption::class);
    }


}
