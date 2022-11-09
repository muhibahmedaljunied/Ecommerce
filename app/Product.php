<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','category_id','country_id','size_id','qty','price','discount','image','status'];

}
