<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductFamilyAttribute;
use App\Models\Product;

class ProductFamilyAttributeFactory extends Factory
{
    protected $model = ProductFamilyAttribute::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'attribute_family_mapping_id' => 1,
            'qty' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 10, 200),
            'alert_qty' => $this->faker->numberBetween(0, 5)
        ];
    }
}
