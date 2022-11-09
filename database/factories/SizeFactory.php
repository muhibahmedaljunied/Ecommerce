<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Size;

$factory->define(Size::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'status' => mt_rand(0,1),
        'created_at' => date_create(),
        'updated_at' => date_create(),
    ];
});
