<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Category;


$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'image' => $faker->image,
        'status' => mt_rand(0,1),
        'created_at' => date_create(),
        'updated_at' => date_create(),

        
    ];
});
