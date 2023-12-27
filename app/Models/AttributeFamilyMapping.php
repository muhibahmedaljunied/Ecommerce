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

}
