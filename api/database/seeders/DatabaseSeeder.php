<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\TimeCapsule;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // creating some mockup data  
        User::factory()
            ->has(TimeCapsule::factory()->count(30))
            ->count(5)
            ->create();

        // create a default admin user
        $defaultUser = User::where('email', 'admin@example.com')->first();
        if (!$defaultUser) {
            $defaultUser = User::factory()->create([
                'name' => 'Jon Moreno',
                'email' => 'admin@example.com',
                'role' => 'admin',
            ]);
        }
        TimeCapsule::factory()->count(30)->for($defaultUser)->create();

        // create a default user
        $defaultUser = User::where('email', 'user@example.com')->first();
        if (!$defaultUser) {
            $defaultUser = User::factory()->create([
                'name' => 'Jon Moreno',
                'email' => 'user@example.com',
            ]);
        }
        TimeCapsule::factory()->count(30)->for($defaultUser)->create();
    }
}
