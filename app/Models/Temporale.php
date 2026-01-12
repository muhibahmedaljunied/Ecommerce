<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductFamilyAttribute;

class Temporale extends Model
{
    protected $fillable = [
        'product_family_attribute_id', 'qty', 'total'
    ];

    /**
     * Relationship to product family attribute (variant).
     */
    public function productFamilyAttribute()
    {
        return $this->belongsTo(ProductFamilyAttribute::class, 'product_family_attribute_id');
    }
}
