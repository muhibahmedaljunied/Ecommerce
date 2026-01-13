<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AdminWebAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_cannot_view_admin_spa()
    {
        $user = User::factory()->create(['is_admin' => false]);
        $this->actingAs($user);

        $response = $this->get('/');
        $response->assertRedirect('/customer/home');
        // Non-admin users should be redirected to the customer area
    }

    public function test_admin_can_view_admin_spa()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $this->actingAs($user);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('main-sidebar'); // basic sanity check for SPA HTML
    }
}
