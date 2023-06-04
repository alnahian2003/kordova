<?php

namespace Database\Seeders;

use App\Models\Check;
use App\Models\Endpoint;
use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Generate random users with related data
        User::factory()
            ->has(
                Site::factory()
                    ->count(3)
                    ->has(
                        Endpoint::factory()
                            ->count(5)
                            ->has(Check::factory()->count(3))
                    )
            )
            ->create(['name' => 'Al Nahian', 'email' => 'admin@admin.com']);
    }
}
