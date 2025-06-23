<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve the test user (replace with your actual test user ID)
        $user = User::find(1); // Assume your test user has ID 1

        // Retrieve the Admin role (make sure the role is already created)
        $adminRole = Role::where('name', 'Admin')->first();

        // Assign the Admin role to the test user
        if ($user && $adminRole) {
            $user->roles()->attach($adminRole);
        }

        // Optionally, assign other roles or users here
        // Example: Assign 'User' role to another user
        $anotherUser = User::find(2);
        $userRole = Role::where('name', 'User')->first();
        if ($anotherUser && $userRole) {
            $anotherUser->roles()->attach($userRole);
        }

        User::factory(10)->create()->each(function ($user) {
            $user->roles()->attach(2);
        });
    }
}
