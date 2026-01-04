<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = ['user_id','full_name','email_address','phone_no','address'];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
