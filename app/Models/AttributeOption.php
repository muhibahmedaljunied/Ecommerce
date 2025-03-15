<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    use HasFactory;

    
    
    protected $fillable = [
        'code',
        'value',
        'attribute_id',
    ];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

}
