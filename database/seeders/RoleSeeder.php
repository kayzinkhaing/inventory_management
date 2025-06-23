<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the Admin role
        $adminRole = Role::create(['name' => 'Admin']);
        // Create the User role
        $userRole = Role::create(['name' => 'User']);

        // Find the 'manage roles' permission
        $manageRolesPermission = Permission::where('name', 'manage roles')->first();

        // Attach the permission to the Admin role
        $adminRole->permissions()->attach($manageRolesPermission);
    }
}
