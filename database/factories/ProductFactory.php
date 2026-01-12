<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'text' => $this->faker->words(3, true),
            'name' => $this->faker->word,
            'status' => $this->faker->randomElement(['true', 'false']),
            'rank' => null
        ];
    }
}
