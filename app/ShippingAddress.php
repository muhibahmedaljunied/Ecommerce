<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = ['customer_id','full_name','email_address','phone_no','address'];

}
