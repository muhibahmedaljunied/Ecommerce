<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeFamily;
use App\Models\AttributeFamilyMapping;
use App\Models\ProductFamilyAttribute;
use App\Models\Temporale;
use App\Models\StockTransaction;

class StockManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create minimal tables for tests to avoid full migrations and Doctrine DBAL dependency
        // Some schema drop operations may trigger doctrine/dbal code paths on SQLite which
        // can raise a TypeError in this environment. Wrap drops in a try/catch and ignore
        // failures so tests can still create simplified tables.
        try {
            \Illuminate\Support\Facades\Schema::dropIfExists('stock_transactions');
            \Illuminate\Support\Facades\Schema::dropIfExists('temporales');
            \Illuminate\Support\Facades\Schema::dropIfExists('product_family_attributes');
            \Illuminate\Support\Facades\Schema::dropIfExists('attribute_family_mappings');
            \Illuminate\Support\Facades\Schema::dropIfExists('attribute_families');
            \Illuminate\Support\Facades\Schema::dropIfExists('attributes');
            \Illuminate\Support\Facades\Schema::dropIfExists('products');
            \Illuminate\Support\Facades\Schema::dropIfExists('orders');
        } catch (\Throwable $e) {
            // ignore schema drop errors (DBAL / SQLite differences in test env)
        }

        if (!\Illuminate\Support\Facades\Schema::hasTable('products')) {
            \Illuminate\Support\Facades\Schema::create('products', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('status')->nullable();
                $table->timestamps();
            });
        }

        if (!\Illuminate\Support\Facades\Schema::hasTable('attributes')) {
            \Illuminate\Support\Facades\Schema::create('attributes', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->increments('id');
                $table->string('code');
                $table->string('name');
                $table->timestamps();
            });
        }

        if (!\Illuminate\Support\Facades\Schema::hasTable('attribute_families')) {
            \Illuminate\Support\Facades\Schema::create('attribute_families', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->increments('id');
                $table->string('code');
                $table->string('name');
                $table->timestamps();
            });
        }

        if (!\Illuminate\Support\Facades\Schema::hasTable('attribute_family_mappings')) {
            \Illuminate\Support\Facades\Schema::create('attribute_family_mappings', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('attribute_id');
                $table->unsignedInteger('attribute_family_id');
                $table->timestamps();
            });
        }

        if (!\Illuminate\Support\Facades\Schema::hasTable('product_family_attributes')) {
            \Illuminate\Support\Facades\Schema::create('product_family_attributes', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('product_id');
                $table->unsignedInteger('attribute_family_mapping_id');
                $table->integer('qty')->default(0);
                $table->decimal('price', 10, 2)->default(0);
                $table->integer('alert_qty')->default(0);
                $table->timestamps();
            });
        }

        if (!\Illuminate\Support\Facades\Schema::hasTable('temporales')) {
            \Illuminate\Support\Facades\Schema::create('temporales', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('product_family_attribute_id');
                $table->integer('qty');
                $table->decimal('total', 10, 2)->nullable();
                $table->timestamps();
            });
        }

        if (!\Illuminate\Support\Facades\Schema::hasTable('stock_transactions')) {
            \Illuminate\Support\Facades\Schema::create('stock_transactions', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('product_family_attribute_id');
                $table->integer('change');
                $table->string('type');
                $table->unsignedInteger('reference_id')->nullable();
                $table->string('reference_type')->nullable();
                $table->unsignedInteger('user_id')->nullable();
                $table->text('note')->nullable();
                $table->timestamps();
            });
        }

        if (!\Illuminate\Support\Facades\Schema::hasTable('orders')) {
            \Illuminate\Support\Facades\Schema::create('orders', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->increments('id');
                $table->decimal('order_total', 10, 2)->default(0);
                $table->timestamps();
            });
        }
    }

    public function test_add_to_cart_prevents_adding_more_than_available()
    {
        $product = Product::create(['text' => 'T-Shirt', 'name' => 'T-Shirt', 'status' => 'true']);
        $attribute = Attribute::create(['code' => 'size', 'name' => 'Size']);
        $family = AttributeFamily::create(['code' => 'pack', 'name' => 'Default']);
        $mapping = AttributeFamilyMapping::create(['attribute_id' => $attribute->id, 'attribute_family_id' => $family->id]);

        $variant = ProductFamilyAttribute::create([
            'product_id' => $product->id,
            'attribute_family_mapping_id' => $mapping->id,
            'qty' => 5,
            'price' => 100
        ]);

        // Try to add more than available
        $response = $this->get('/add-cart/' . $variant->id . '/6');
        $response->assertStatus(400);
        $response->assertJson(['error' => 'Not enough stock available']);

        // Add allowable qty
        $response = $this->get('/add-cart/' . $variant->id . '/3');
        $response->assertStatus(200);
        $this->assertDatabaseHas('temporales', ['product_family_attribute_id' => $variant->id, 'qty' => 3]);

        // Adding more to exceed
        $response = $this->get('/add-cart/' . $variant->id . '/3');
        $response->assertStatus(400);
    }

    public function test_update_cart_prevents_setting_quantity_above_available()
    {
        $product = Product::create(['text' => 'T-Shirt', 'name' => 'T-Shirt', 'status' => 'true']);
        $attribute = Attribute::create(['code' => 'size', 'name' => 'Size']);
        $family = AttributeFamily::create(['code' => 'pack', 'name' => 'Default']);
        $mapping = AttributeFamilyMapping::create(['attribute_id' => $attribute->id, 'attribute_family_id' => $family->id]);

        $variant = ProductFamilyAttribute::create([
            'product_id' => $product->id,
            'attribute_family_mapping_id' => $mapping->id,
            'qty' => 5,
            'price' => 100
        ]);

        $temporale = Temporale::create(['product_family_attribute_id' => $variant->id, 'qty' => 2, 'total' => 200]);

        $response = $this->post('/update-cart', ['id' => $temporale->id, 'qty' => 10]);
        $response->assertStatus(400);
        $response->assertJson(['error' => 'Not enough stock available']);

        $response = $this->post('/update-cart', ['id' => $temporale->id, 'qty' => 4]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('temporales', ['id' => $temporale->id, 'qty' => 4]);
    }

    public function test_checkout_decrements_stock_and_logs_transaction()
    {
        $product = Product::create(['text' => 'T-Shirt', 'name' => 'T-Shirt', 'status' => 'true']);
        $attribute = Attribute::create(['code' => 'size', 'name' => 'Size']);
        $family = AttributeFamily::create(['code' => 'pack', 'name' => 'Default']);
        $mapping = AttributeFamilyMapping::create(['attribute_id' => $attribute->id, 'attribute_family_id' => $family->id]);

        $variant = ProductFamilyAttribute::create([
            'product_id' => $product->id,
            'attribute_family_mapping_id' => $mapping->id,
            'qty' => 10,
            'price' => 100,
            'alert_qty' => 2
        ]);

        $temporale = Temporale::create(['product_family_attribute_id' => $variant->id, 'qty' => 3, 'total' => 300]);

        $response = $this->post('/customer/confirm-order', [
            'type_pay' => 'cash',
            'type' => 'cash',
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'number' => '1234567890',
            'address' => '123 Street'
        ]);

        $response->assertStatus(200);

        $variant->refresh();
        $this->assertEquals(7, $variant->qty);

        $this->assertDatabaseHas('stock_transactions', [
            'product_family_attribute_id' => $variant->id,
            'change' => -3,
            'type' => 'sale'
        ]);

        $this->assertDatabaseMissing('temporales', ['product_family_attribute_id' => $variant->id]);

        $this->assertDatabaseHas('orders', ['order_total' => 300]);
    }

    public function test_checkout_fails_when_insufficient_stock()
    {
        $product = Product::create(['text' => 'T-Shirt', 'name' => 'T-Shirt', 'status' => 'true']);
        $attribute = Attribute::create(['code' => 'size', 'name' => 'Size']);
        $family = AttributeFamily::create(['code' => 'pack', 'name' => 'Default']);
        $mapping = AttributeFamilyMapping::create(['attribute_id' => $attribute->id, 'attribute_family_id' => $family->id]);

        $variant = ProductFamilyAttribute::create([
            'product_id' => $product->id,
            'attribute_family_mapping_id' => $mapping->id,
            'qty' => 2,
            'price' => 100
        ]);

        $temporale = Temporale::create(['product_family_attribute_id' => $variant->id, 'qty' => 3, 'total' => 300]);

        $response = $this->post('/customer/confirm-order', [
            'type_pay' => 'cash',
            'type' => 'cash',
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'number' => '1234567890',
            'address' => '123 Street'
        ]);

        // Should fail due to insufficient stock - expect server error (exception bubbled)
        $response->assertStatus(400);

        $variant->refresh();
        $this->assertEquals(2, $variant->qty);

        // Temporale should still exist
        $this->assertDatabaseHas('temporales', ['product_family_attribute_id' => $variant->id]);
    }

    public function test_get_latest_transaction_returns_latest()
    {
        $product = Product::create(['text' => 'T-Shirt', 'name' => 'T-Shirt', 'status' => 'true']);
        $attribute = Attribute::create(['code' => 'size', 'name' => 'Size']);
        $family = AttributeFamily::create(['code' => 'pack', 'name' => 'Default']);
        $mapping = AttributeFamilyMapping::create(['attribute_id' => $attribute->id, 'attribute_family_id' => $family->id]);

        $variant = ProductFamilyAttribute::create([
            'product_id' => $product->id,
            'attribute_family_mapping_id' => $mapping->id,
            'qty' => 10,
            'price' => 100
        ]);

        // Make sure the test controls the dataset so latest is deterministic
        \App\Models\StockTransaction::truncate();

        $t1 = StockTransaction::create(['product_family_attribute_id' => $variant->id, 'change' => -2, 'type' => 'sale', 'created_at' => now()->subMinutes(2)]);
        // ensure t2 is definitely the newest record even if other data exists
        $t2 = StockTransaction::create(['product_family_attribute_id' => $variant->id, 'change' => -1, 'type' => 'adjustment', 'created_at' => now()->addMinute()]);

        // authenticate so admin routes return JSON instead of redirecting to login
        $user = \App\Models\User::create(['name' => 'Tester', 'email' => 'tester1@example.com', 'password' => bcrypt('password')]);
        $this->actingAs($user);

        $response = $this->get('/stock/transactions/latest');
        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $t2->id]);
    }

    public function test_get_latest_transaction_filtered_by_variant()
    {
        $product = Product::create(['text' => 'T-Shirt', 'name' => 'T-Shirt', 'status' => 'true']);
        $attribute = Attribute::create(['code' => 'size', 'name' => 'Size']);
        $family = AttributeFamily::create(['code' => 'pack', 'name' => 'Default']);
        $mapping = AttributeFamilyMapping::create(['attribute_id' => $attribute->id, 'attribute_family_id' => $family->id]);

        $variant1 = ProductFamilyAttribute::create([
            'product_id' => $product->id,
            'attribute_family_mapping_id' => $mapping->id,
            'qty' => 10,
            'price' => 100
        ]);

        $variant2 = ProductFamilyAttribute::create([
            'product_id' => $product->id,
            'attribute_family_mapping_id' => $mapping->id,
            'qty' => 10,
            'price' => 100
        ]);

        \App\Models\StockTransaction::truncate();

        $t1 = StockTransaction::create(['product_family_attribute_id' => $variant1->id, 'change' => -2, 'type' => 'sale', 'created_at' => now()->subMinutes(2)]);
        // ensure the second transaction is the newest
        $t2 = StockTransaction::create(['product_family_attribute_id' => $variant2->id, 'change' => -1, 'type' => 'adjustment', 'created_at' => now()->addMinute()]);

        $user = \App\Models\User::create(['name' => 'Tester', 'email' => 'tester2@example.com', 'password' => bcrypt('password')]);
        $this->actingAs($user);

        $response = $this->get('/stock/transactions/latest?variant_id=' . $variant1->id);
        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $t1->id]);
    }

    public function test_get_latest_transaction_returns_404_when_none_exist()
    {
        $user = \App\Models\User::create(['name' => 'Tester', 'email' => 'tester3@example.com', 'password' => bcrypt('password')]);
        $this->actingAs($user);

        // Ensure there are no transactions
        \App\Models\StockTransaction::truncate();

        $response = $this->get('/stock/transactions/latest');
        $response->assertStatus(404);
    }
}
