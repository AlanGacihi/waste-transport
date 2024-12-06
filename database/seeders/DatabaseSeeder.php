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
        ]);

        $user = User::find(1); // Find the user by ID
        $user->is_admin = true;
        $user->save();

        $this->call([
            MenuItemSeeder::class,
            ServiceSeeder::class,
            CalendarSeeder::class,
            ResDemSeeder::class,
        ]);
    }
}
