<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $authCategory = Category::where('slug', 'authentication-authorization')->first();
        $apiCategory = Category::where('slug', 'api-development')->first();
        $databaseCategory = Category::where('slug', 'database-orm')->first();
        $testingCategory = Category::where('slug', 'testing-debugging')->first();

        // Authentication & Authorization Packages
        Package::create([
            'category_id' => $authCategory->id,
            'name' => 'Laravel Sanctum',
            'slug' => 'laravel-sanctum',
            'description' => 'Laravel Sanctum provides a featherweight authentication system for SPAs and simple APIs.',
            'composer_package' => 'laravel/sanctum',
            'documentation_url' => 'https://laravel.com/docs/sanctum',
            'github_url' => 'https://github.com/laravel/sanctum',
            'difficulty_level' => 'beginner',
            'is_official' => true,
            'popularity_score' => 95,
        ]);

        Package::create([
            'category_id' => $authCategory->id,
            'name' => 'Laravel Passport',
            'slug' => 'laravel-passport',
            'description' => 'Laravel Passport provides a full OAuth2 server implementation for your Laravel application.',
            'composer_package' => 'laravel/passport',
            'documentation_url' => 'https://laravel.com/docs/passport',
            'github_url' => 'https://github.com/laravel/passport',
            'difficulty_level' => 'advanced',
            'is_official' => true,
            'popularity_score' => 90,
        ]);

        Package::create([
            'category_id' => $authCategory->id,
            'name' => 'Laravel Fortify',
            'slug' => 'laravel-fortify',
            'description' => 'Laravel Fortify is a frontend agnostic authentication backend for Laravel.',
            'composer_package' => 'laravel/fortify',
            'documentation_url' => 'https://laravel.com/docs/fortify',
            'github_url' => 'https://github.com/laravel/fortify',
            'difficulty_level' => 'intermediate',
            'is_official' => true,
            'popularity_score' => 85,
        ]);

        // API Development Packages
        Package::create([
            'category_id' => $apiCategory->id,
            'name' => 'API Resources',
            'slug' => 'api-resources',
            'description' => 'Transform your models and model collections into JSON responses with Laravel API Resources.',
            'composer_package' => null,
            'documentation_url' => 'https://laravel.com/docs/eloquent-resources',
            'github_url' => null,
            'difficulty_level' => 'beginner',
            'is_official' => true,
            'popularity_score' => 88,
        ]);

        Package::create([
            'category_id' => $apiCategory->id,
            'name' => 'Laravel Pail',
            'slug' => 'laravel-pail',
            'description' => 'Dive into your Laravel application\'s log files directly from the command line.',
            'composer_package' => 'laravel/pail',
            'documentation_url' => 'https://laravel.com/docs/pail',
            'github_url' => 'https://github.com/laravel/pail',
            'difficulty_level' => 'beginner',
            'is_official' => true,
            'popularity_score' => 75,
        ]);

        // Database & ORM Packages
        Package::create([
            'category_id' => $databaseCategory->id,
            'name' => 'Eloquent ORM',
            'slug' => 'eloquent-orm',
            'description' => 'Laravel\'s Eloquent ORM provides a beautiful, simple ActiveRecord implementation for working with your database.',
            'composer_package' => null,
            'documentation_url' => 'https://laravel.com/docs/eloquent',
            'github_url' => null,
            'difficulty_level' => 'beginner',
            'is_official' => true,
            'popularity_score' => 100,
        ]);

        Package::create([
            'category_id' => $databaseCategory->id,
            'name' => 'Database Migrations',
            'slug' => 'database-migrations',
            'description' => 'Migrations are like version control for your database, allowing your team to define and share the application\'s database schema.',
            'composer_package' => null,
            'documentation_url' => 'https://laravel.com/docs/migrations',
            'github_url' => null,
            'difficulty_level' => 'beginner',
            'is_official' => true,
            'popularity_score' => 98,
        ]);

        // Testing & Debugging Packages
        Package::create([
            'category_id' => $testingCategory->id,
            'name' => 'Laravel Telescope',
            'slug' => 'laravel-telescope',
            'description' => 'Telescope provides insight into the requests coming into your application, exceptions, log entries, database queries, queued jobs, and more.',
            'composer_package' => 'laravel/telescope',
            'documentation_url' => 'https://laravel.com/docs/telescope',
            'github_url' => 'https://github.com/laravel/telescope',
            'difficulty_level' => 'intermediate',
            'is_official' => true,
            'popularity_score' => 92,
        ]);

        Package::create([
            'category_id' => $testingCategory->id,
            'name' => 'Pest PHP',
            'slug' => 'pest-php',
            'description' => 'Pest is an elegant PHP testing framework with a focus on simplicity, built on top of PHPUnit.',
            'composer_package' => 'pestphp/pest',
            'documentation_url' => 'https://pestphp.com',
            'github_url' => 'https://github.com/pestphp/pest',
            'difficulty_level' => 'intermediate',
            'is_official' => false,
            'popularity_score' => 87,
        ]);
    }
}
