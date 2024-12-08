<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'is_admin' => 0,
        ]);

        // Create an admin user with password 'admin'
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'admin',
            'is_admin' => 1,
        ]);

        $this->call([
            MenuItemSeeder::class,
            ServiceSeeder::class,
            CalendarSeeder::class,
            ResDemSeeder::class,
        ]);
    }
}
