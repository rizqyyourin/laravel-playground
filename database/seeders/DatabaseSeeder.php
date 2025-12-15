<?php

namespace Database\Seeders;

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
        // Create a test user
        User::factory()->create([
            'name' => 'Laravel Playground User',
            'email' => 'user@laravelplayground.test',
        ]);

        // Seed categories, packages, tutorials, and code examples
        $this->call([
            CategorySeeder::class,
            PackageSeeder::class,
            TutorialSeeder::class,
            CodeExampleSeeder::class,
        ]);
    }
}
