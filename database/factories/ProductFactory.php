<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Product;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'category_id' => $faker->randomElement([1,2,33,34,35,36,37]),
        'size_id' => $faker->randomElement([1,12,13,14,15,16,17]),
        'country_id' => $faker->randomElement([1,12,13,14,15,16,17]), 
        'qty' => mt_rand(1,10),
        'price' => mt_rand(1500,6000),
        'discount' => mt_rand(1,10),
        'image' => $faker->image,
        'status' => mt_rand(0,1),
        'created_at' => date_create(),
        'updated_at' => date_create(),
    ];
});
