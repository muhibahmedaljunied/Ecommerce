<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeFamilyMapping extends Model
{
    use HasFactory;

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }


    public function attribute_family()
    {
        return $this->belongsTo(AttributeFamily::class);
    }


    public function product_family_attribute()
    {
        return $this->hasMany(ProductFamilyAttribute::class);
    }

    

    public function family_attribute_option()
    {
        return $this->hasMany(FamilyAttributeOption::class);
    }


}
