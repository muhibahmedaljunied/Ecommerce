<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeFamily;
use App\Models\AttributeFamilyMapping;
use App\Models\ProductFamilyAttribute;
use App\Models\StockTransaction;
use Illuminate\Support\Str;

class StockSeeder extends Seeder
{
    public function run()
    {
        // Configurable counts via env (defaults shown)
        $productsCount = (int) env('STOCK_SEED_PRODUCTS', 3);
        $variantsPerProduct = (int) env('STOCK_SEED_VARIANTS', 2);
        $transactionsPerVariant = (int) env('STOCK_SEED_TRANSACTIONS', 2);

        // Ensure a minimal attribute/family/mapping exists
        $attribute = Attribute::firstOrCreate(['code' => 'size'], ['name' => 'Size']);
        $family = AttributeFamily::firstOrCreate(['code' => 'pack'], ['name' => 'Default']);
        $mapping = AttributeFamilyMapping::firstOrCreate([
            'attribute_id' => $attribute->id,
            'attribute_family_id' => $family->id
        ]);

        // Use factories to create products, variants and transactions
        Product::factory()
            ->count($productsCount)
            ->create()
            ->each(function ($product) use ($variantsPerProduct, $transactionsPerVariant, $mapping) {
                // create variants for product
                $variants = ProductFamilyAttribute::factory()
                    ->count($variantsPerProduct)
                    ->state(['attribute_family_mapping_id' => $mapping->id])
                    ->for($product, 'product')
                    ->create();

                foreach ($variants as $variant) {
                    StockTransaction::factory()
                        ->count($transactionsPerVariant)
                        ->state(['product_family_attribute_id' => $variant->id])
                        ->create();
                }
            });
    }
}
