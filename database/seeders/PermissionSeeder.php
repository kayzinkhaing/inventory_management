<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 'manage roles' permission
        Permission::create(['name' => 'manage roles']);
        Permission::create(['name' => 'manage permissions']);
        Permission::create(['name' => 'view dashboard']);
        Permission::create(['name' => 'edit posts']);
        Permission::create(['name' => 'add_permissions_to_roles']);

        // $modules = ['category', 'campaign','type','user','withdraw','donation','transition','role','permission'];
        // $actions = ['view','create', 'update', 'delete'];

        // foreach ($modules as $module) {
        //     foreach ($actions as $action) {
        //         Permission::firstOrCreate(['name' => "$module.$action"]);
        //     }
        // }

    }
}
