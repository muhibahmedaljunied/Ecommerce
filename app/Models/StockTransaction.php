<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_family_attribute_id',
        'change',
        'type',
        'reference_id',
        'reference_type',
        'user_id',
        'note'
    ];

    public function variant()
    {
        return $this->belongsTo(ProductFamilyAttribute::class, 'product_family_attribute_id');
    }
}
