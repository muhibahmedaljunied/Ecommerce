<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductFamilyAttribute;
use App\Models\StockTransaction;
use App\Models\Attribute;
use App\Models\AttributeFamily;
use App\Models\AttributeFamilyMapping;

class AdminStockTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_lists_stocks_with_last_transaction_and_low_stock_flag()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create required attribute mapping (some migrations rely on these records)
        $attribute = Attribute::create(['code' => 'size', 'name' => 'Size']);
        $family = AttributeFamily::create(['code' => 'pack', 'name' => 'Default']);
        $mapping = AttributeFamilyMapping::create(['attribute_id' => $attribute->id, 'attribute_family_id' => $family->id]);

        // Create a variant (product created by factory automatically)
        $variant = ProductFamilyAttribute::factory()->create([
            'qty' => 2,
            'alert_qty' => 5,
            'attribute_family_mapping_id' => $mapping->id
        ]);

        // Ensure product name is deterministic for the assertion
        $product = $variant->product;
        $product->name = 'Test Product';
        $product->save();

        $tx = StockTransaction::factory()->create([
            'product_family_attribute_id' => $variant->id,
            'change' => -1,
            'type' => 'sale'
        ]);

        $response = $this->getJson('/api/admin/stocks');

        $response->assertStatus(200);

        $json = $response->json();

        $this->assertArrayHasKey('data', $json);
        $first = $json['data'][0];

        $this->assertEquals($variant->id, $first['id']);
        $this->assertEquals('Test Product', $first['product_name']);
        $this->assertEquals(2, $first['qty']);
        $this->assertTrue($first['low_stock']);
        $this->assertNotNull($first['last_transaction']);
        $this->assertEquals($tx->id, $first['last_transaction']['id']);
    }
}
