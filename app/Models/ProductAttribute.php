<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = [
        'category_id',
        'country_id',
        'size_id',
        'brand_id',
        'color_id',
        'age_id',
      
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
