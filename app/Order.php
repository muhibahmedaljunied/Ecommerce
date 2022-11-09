<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\OrderDetail;

class Order extends Model
{
    public function User(){
        return $this->belongsTo(User::class);
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
}
