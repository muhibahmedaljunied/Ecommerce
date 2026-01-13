<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_cannot_access_admin_api()
    {
        $user = User::factory()->create(['is_admin' => false]);
        $this->actingAs($user);

        $response = $this->getJson('/api/admin/stocks');
        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_api()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $response = $this->getJson('/api/admin/stocks');
        // 200 or empty data is acceptable - we check for non-403
        $this->assertTrue(in_array($response->status(), [200, 204]));
    }
}
