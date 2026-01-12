<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Only create test users in local/development environment
        if (app()->environment('local', 'development')) {
            User::factory(10)->create();

            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        } else {
            // In production, create only admin user with hash
            User::firstOrCreate(
                ['email' => 'admin@elevasi.com'],
                [
                    'name' => 'Admin',
                    'password' => Hash::make('password'), // CHANGE THIS PASSWORD!
                    'email_verified_at' => now(),
                ]
            );
        }

        // Production-safe seeders
        $this->call([
            CategorySeeder::class,
            SettingSeeder::class,
            ProjectSeeder::class,
            TeamMemberSeeder::class,
            TimelineItemSeeder::class,
            CompanyValueSeeder::class,
            AboutSectionSeeder::class,
        ]);
    }
}
