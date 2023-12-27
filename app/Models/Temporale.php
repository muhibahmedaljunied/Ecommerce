<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporale extends Model
{
    protected $fillable = [
        'product_id', 'customer_id','qty','type_process'
    ];
}
