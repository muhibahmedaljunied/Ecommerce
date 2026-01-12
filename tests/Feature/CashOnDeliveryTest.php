<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Temporale;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeFamily;
use App\Models\AttributeFamilyMapping;
use App\Models\ProductFamilyAttribute;

class CashOnDeliveryTest extends TestCase
{
    use RefreshDatabase;

    public function test_cash_on_delivery_checkout_processes_order_and_clears_cart()
    {
        // Create product and variant
        $product = Product::create(['text' => 'CoD Shirt', 'name' => 'CoD Shirt', 'status' => 'true']);
        $attribute = Attribute::create(['code' => 'size', 'name' => 'Size']);
        $family = AttributeFamily::create(['code' => 'pack', 'name' => 'Default']);
        $mapping = AttributeFamilyMapping::create(['attribute_id' => $attribute->id, 'attribute_family_id' => $family->id]);

        $variant = ProductFamilyAttribute::create([
            'product_id' => $product->id,
            'attribute_family_mapping_id' => $mapping->id,
            'qty' => 10,
            'price' => 50
        ]);

        // Add an item to temporales (cart)
        Temporale::create(['product_family_attribute_id' => $variant->id, 'qty' => 2, 'total' => 100]);

        // Perform the Cash-on-Delivery checkout via the controller route used in app
        $response = $this->post('/customer/confirm-order', [
            'type_pay' => 'cash',
            'type' => 'cash',
            'full_name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'number' => '1234567890',
            'address' => '1 Test Street'
        ]);

        $response->assertStatus(200);

        // Assert temporales is cleared
        $this->assertDatabaseMissing('temporales', ['product_family_attribute_id' => $variant->id]);

        // Variant qty should be decremented by 2
        $variant->refresh();
        $this->assertEquals(8, $variant->qty);

        // Assert an order created with expected total
        $this->assertDatabaseHas('orders', ['order_total' => 100]);

        // Assert stock transaction logged
        $this->assertDatabaseHas('stock_transactions', [
            'product_family_attribute_id' => $variant->id,
            'change' => -2,
            'type' => 'sale'
        ]);
    }
}
