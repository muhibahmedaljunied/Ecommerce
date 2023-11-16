<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $hidden = ['created_at','updated_at','deleted_at'];
    protected $fillable = ['name','category_id','country_id','size_id','qty','price','discount','image','status'];

}
