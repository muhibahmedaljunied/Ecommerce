<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class RBACFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_role_and_permissions_seeded_and_assigned()
    {
        // run seeder manually here if test harness doesn't auto-run DatabaseSeeder
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);

        $adminRole = Role::where('name', 'admin')->first();
        $this->assertNotNull($adminRole);

        $this->assertTrue(Permission::where('name','access-admin')->exists());

        $user = User::factory()->create(['is_admin'=> true]);
        $user->roles()->attach($adminRole->id);

        $this->assertTrue($user->hasRole('admin'));
        $this->assertTrue($user->hasPermission('manage-users'));
    }

    public function test_permission_middleware_blocks_non_permitted_user()
    {
        $this->seed(\Database\Seeders\RolePermissionSeeder::class);

        $user = User::factory()->create(['is_admin' => false]);
        $this->actingAs($user);

        $response = $this->getJson('/api/admin/stocks');
        $response->assertStatus(403);

        $admin = User::factory()->create(['is_admin' => true]);
        $admin->roles()->attach(Role::where('name','admin')->first());
        $this->actingAs($admin);
        $response = $this->getJson('/api/admin/stocks');
        $this->assertTrue(in_array($response->status(), [200,204]));
    }
}
