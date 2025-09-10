<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin account
        User::create([
            'name' => 'Main Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), 
            'role' => 'admin',
        ]);

        // Organizer account
        User::create([
            'name' => 'Event Organizer',
            'email' => 'organizer@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'organizer',
        ]);

        // Some students using factory
        User::factory()->count(5)->create([
            'role' => 'student',
        ]);
    }
}
