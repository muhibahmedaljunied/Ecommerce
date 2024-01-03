<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyAttributeOption extends Model
{
    use HasFactory;

    public function attribute_family_mapping()
    {
        return $this->belongsTo(AttributeFamilyMapping::class);
    }

    public function product_family_attribute()
    {
        return $this->belongsTo(ProductFamilyAttribute::class);
    }


    public function attribute_option()
    {
        return $this->belongsTo(AttributeOption::class);
    }

   


}
