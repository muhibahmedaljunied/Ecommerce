<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $casts = [
        'price' => 'decimal:2',
        'total' => 'decimal:2',
    ];
}
