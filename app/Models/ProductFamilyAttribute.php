<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFamilyAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'attribute_family_mapping_id',
        'qty',
        'price',
        'discount',
        'image',
        'new',
        'featured',
        'description',
        'alert_qty'
    ];

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

    /**
     * Stock transactions for this variant (most recent transactions can be fetched with a query limit)
     */
    public function stockTransactions()
    {
        return $this->hasMany(\App\Models\StockTransaction::class, 'product_family_attribute_id');
    }

    /**
     * Returns true if current qty is at or below alert threshold
     */
    public function isLowStock()
    {
        return $this->alert_qty !== null && $this->qty <= $this->alert_qty;
    }

}
