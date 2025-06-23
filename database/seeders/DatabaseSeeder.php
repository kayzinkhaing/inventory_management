<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Test User KZK',
            'email' => 'kzk1331@gmail.com',
            'password' => bcrypt('password')
        ]);

        $this->call([
        CategorySeeder::class,
        BrandSeeder::class,
        ProductSeeder::class,
        ImageSeeder::class,
        MessageSeeder::class,
        RoleSeeder::class,
        PermissionSeeder::class,
    ]);
    }
}
