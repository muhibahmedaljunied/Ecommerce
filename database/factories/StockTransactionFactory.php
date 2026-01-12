<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\StockTransaction;
use App\Models\ProductFamilyAttribute;

class StockTransactionFactory extends Factory
{
    protected $model = StockTransaction::class;

    public function definition()
    {
        return [
            'product_family_attribute_id' => ProductFamilyAttribute::factory(),
            'change' => $this->faker->randomElement([-5, -3, -2, -1, 1, 2, 3]),
            'type' => $this->faker->randomElement(['sale', 'adjustment']),
            'created_at' => now()->subMinutes($this->faker->numberBetween(1, 500)),
            'updated_at' => now()->subMinutes($this->faker->numberBetween(1, 500))
        ];
    }
}
