<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\OrderDetail;

class Order extends Model
{
    protected $casts = [
        'order_total' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function User(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
}
