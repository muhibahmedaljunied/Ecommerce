<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $admin = Role::firstOrCreate(['name' => 'admin'], ['label' => 'Administrator']);
        $customer = Role::firstOrCreate(['name' => 'customer'], ['label' => 'Customer']);

        // Create permissions
        $permissions = [
            'access-admin',
            'manage-users',
            'manage-products',
            'view-orders',
            'manage-orders'
        ];

        foreach ($permissions as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        // Attach all permissions to admin
        $admin->permissions()->sync(Permission::pluck('id')->toArray());

        // By default, customers get view-orders permission
        $customerPermission = Permission::where('name', 'view-orders')->first();
        if ($customerPermission) {
            $customer->permissions()->sync([$customerPermission->id]);
        }

        // Assign role to existing users with is_admin = true
        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $u) {
            if (!$u->hasRole('admin')) {
                $u->roles()->attach($admin->id);
            }
        }
    }
}
