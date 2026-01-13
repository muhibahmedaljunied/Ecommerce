<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Providers\RouteServiceProvider;

class AdminLoginProtectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_cannot_login_when_intended_admin_url()
    {
        $user = User::factory()->create([
            'password' => bcrypt('secret'),
            'is_admin' => false,
        ]);

        // Simulate that the user was redirected from an admin page (intended URL)
        $this->withSession(['url.intended' => '/']);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_admin_can_login_from_admin_page()
    {
        $admin = User::factory()->create([
            'password' => bcrypt('secret'),
            'is_admin' => true,
        ]);

        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'secret',
            'admin' => '1',
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
        $this->assertAuthenticatedAs($admin);
    }
}
