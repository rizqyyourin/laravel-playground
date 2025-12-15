<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Tutorial;
use Illuminate\Database\Seeder;

class TutorialSeeder extends Seeder
{
    public function run(): void
    {
        // Get packages
        $sanctum = Package::where('slug', 'laravel-sanctum')->first();
        $eloquent = Package::where('slug', 'eloquent-orm')->first();
        $apiResources = Package::where('slug', 'api-resources')->first();

        // Laravel Sanctum Tutorials
        if ($sanctum) {
            Tutorial::create([
                'package_id' => $sanctum->id,
                'title' => 'Getting Started with Sanctum',
                'slug' => 'getting-started-with-sanctum',
                'content' => "Laravel Sanctum provides a featherweight authentication system for SPAs and simple APIs.\n\nIn this tutorial, you'll learn how to:\n- Install and configure Sanctum\n- Add the HasApiTokens trait to your User model\n- Issue API tokens to users\n- Protect your API routes\n\nSanctum is perfect for applications that need simple token-based authentication without the complexity of OAuth2.",
                'order' => 1,
                'estimated_time' => 10,
            ]);

            Tutorial::create([
                'package_id' => $sanctum->id,
                'title' => 'Issuing API Tokens',
                'slug' => 'issuing-api-tokens',
                'content' => "Learn how to issue API tokens to your users for authentication.\n\nAPI tokens allow your users to authenticate API requests without using sessions or cookies. This is perfect for mobile apps, SPAs, or third-party integrations.\n\nYou'll learn:\n- How to create tokens with custom names\n- How to add abilities to tokens\n- How to revoke tokens\n- Best practices for token management",
                'order' => 2,
                'estimated_time' => 15,
            ]);

            Tutorial::create([
                'package_id' => $sanctum->id,
                'title' => 'Protecting Routes with Sanctum',
                'slug' => 'protecting-routes-with-sanctum',
                'content' => "Secure your API endpoints using Sanctum's authentication middleware.\n\nLearn how to:\n- Protect routes with the auth:sanctum middleware\n- Access the authenticated user\n- Handle unauthorized requests\n- Test your protected routes\n\nSanctum makes it easy to secure your API while maintaining simplicity.",
                'order' => 3,
                'estimated_time' => 12,
            ]);
        }

        // Eloquent ORM Tutorials
        if ($eloquent) {
            Tutorial::create([
                'package_id' => $eloquent->id,
                'title' => 'Eloquent Relationships',
                'slug' => 'eloquent-relationships',
                'content' => "Master Eloquent relationships to build powerful database queries.\n\nEloquent makes it easy to work with related database records. You'll learn:\n- One-to-One relationships\n- One-to-Many relationships\n- Many-to-Many relationships\n- Polymorphic relationships\n- Eager loading to prevent N+1 queries\n\nUnderstanding relationships is key to building efficient Laravel applications.",
                'order' => 1,
                'estimated_time' => 20,
            ]);

            Tutorial::create([
                'package_id' => $eloquent->id,
                'title' => 'Query Scopes and Accessors',
                'slug' => 'query-scopes-and-accessors',
                'content' => "Learn how to write reusable query logic with scopes and transform attributes with accessors.\n\nQuery scopes allow you to define common query constraints that you can reuse throughout your application. Accessors let you format attributes when retrieving them from the database.\n\nYou'll learn:\n- Creating local and global scopes\n- Using accessors and mutators\n- Attribute casting\n- Best practices for clean code",
                'order' => 2,
                'estimated_time' => 18,
            ]);
        }

        // API Resources Tutorials
        if ($apiResources) {
            Tutorial::create([
                'package_id' => $apiResources->id,
                'title' => 'Creating API Resources',
                'slug' => 'creating-api-resources',
                'content' => "Transform your Eloquent models into JSON responses with API Resources.\n\nAPI Resources provide a transformation layer between your Eloquent models and the JSON responses that are returned by your API.\n\nLearn how to:\n- Create resource classes\n- Transform model data\n- Include relationships conditionally\n- Format dates and attributes\n- Return consistent API responses",
                'order' => 1,
                'estimated_time' => 15,
            ]);

            Tutorial::create([
                'package_id' => $apiResources->id,
                'title' => 'Resource Collections',
                'slug' => 'resource-collections',
                'content' => "Work with collections of resources and add pagination metadata.\n\nResource collections allow you to transform multiple models at once and add custom metadata to your responses.\n\nYou'll learn:\n- Creating resource collections\n- Adding pagination metadata\n- Customizing the resource wrapper\n- Conditional attributes in collections\n- Performance optimization",
                'order' => 2,
                'estimated_time' => 12,
            ]);
        }

        // Database Migrations Tutorials
        $migrations = Package::where('slug', 'database-migrations')->first();
        if ($migrations) {
            Tutorial::create([
                'package_id' => $migrations->id,
                'title' => 'Creating Your First Migration',
                'slug' => 'creating-your-first-migration',
                'content' => "Learn how to create and run database migrations in Laravel.\n\nMigrations are like version control for your database, allowing you to modify your database schema in a structured way.\n\nYou'll learn:\n- Creating migrations with artisan commands\n- Defining table schemas\n- Running and rolling back migrations\n- Best practices for migration files",
                'order' => 1,
                'estimated_time' => 15,
            ]);

            Tutorial::create([
                'package_id' => $migrations->id,
                'title' => 'Modifying Existing Tables',
                'slug' => 'modifying-existing-tables',
                'content' => "Learn how to safely modify existing database tables using migrations.\n\nAs your application evolves, you'll need to add, modify, or remove columns from existing tables.\n\nYou'll learn:\n- Adding new columns\n- Modifying column types\n- Renaming columns\n- Dropping columns safely\n- Handling data during migrations",
                'order' => 2,
                'estimated_time' => 18,
            ]);
        }

        // Laravel Telescope Tutorials
        $telescope = Package::where('slug', 'laravel-telescope')->first();
        if ($telescope) {
            Tutorial::create([
                'package_id' => $telescope->id,
                'title' => 'Getting Started with Telescope',
                'slug' => 'getting-started-with-telescope',
                'content' => "Laravel Telescope is an elegant debug assistant for Laravel applications.\n\nTelescope provides insight into requests, exceptions, database queries, queued jobs, mail, notifications, cache operations, scheduled tasks, and more.\n\nYou'll learn:\n- Installing and configuring Telescope\n- Accessing the Telescope dashboard\n- Understanding different watchers\n- Filtering and searching entries",
                'order' => 1,
                'estimated_time' => 12,
            ]);

            Tutorial::create([
                'package_id' => $telescope->id,
                'title' => 'Debugging with Telescope',
                'slug' => 'debugging-with-telescope',
                'content' => "Master debugging techniques using Laravel Telescope.\n\nTelescope helps you identify performance bottlenecks, track down bugs, and understand your application's behavior.\n\nYou'll learn:\n- Monitoring database queries and N+1 problems\n- Tracking exceptions and errors\n- Analyzing request performance\n- Debugging queued jobs\n- Monitoring cache usage",
                'order' => 2,
                'estimated_time' => 20,
            ]);
        }

        // Pest PHP Tutorials
        $pest = Package::where('slug', 'pest-php')->first();
        if ($pest) {
            Tutorial::create([
                'package_id' => $pest->id,
                'title' => 'Introduction to Pest Testing',
                'slug' => 'introduction-to-pest-testing',
                'content' => "Pest is a delightful PHP testing framework with a focus on simplicity.\n\nPest provides a beautiful and expressive syntax for writing tests, making testing more enjoyable.\n\nYou'll learn:\n- Installing Pest in your Laravel application\n- Writing your first Pest test\n- Understanding test structure\n- Running tests with Pest\n- Pest vs PHPUnit syntax",
                'order' => 1,
                'estimated_time' => 15,
            ]);

            Tutorial::create([
                'package_id' => $pest->id,
                'title' => 'Testing Laravel Features with Pest',
                'slug' => 'testing-laravel-features-with-pest',
                'content' => "Learn how to test Laravel features using Pest's expressive syntax.\n\nPest integrates seamlessly with Laravel, providing helpers for testing routes, databases, and more.\n\nYou'll learn:\n- Testing HTTP endpoints\n- Database testing and factories\n- Testing authentication\n- Using expectations and matchers\n- Organizing tests with datasets",
                'order' => 2,
                'estimated_time' => 22,
            ]);
        }

        // Laravel Passport Tutorials
        $passport = Package::where('slug', 'laravel-passport')->first();
        if ($passport) {
            Tutorial::create([
                'package_id' => $passport->id,
                'title' => 'OAuth2 Server with Passport',
                'slug' => 'oauth2-server-with-passport',
                'content' => "Laravel Passport provides a full OAuth2 server implementation for your Laravel application.\n\nPassport is ideal when you need to implement OAuth2 for third-party integrations or when building a more complex authentication system.\n\nYou'll learn:\n- Installing and configuring Passport\n- Creating OAuth2 clients\n- Issuing access tokens\n- Understanding OAuth2 grant types\n- Passport vs Sanctum comparison",
                'order' => 1,
                'estimated_time' => 25,
            ]);

            Tutorial::create([
                'package_id' => $passport->id,
                'title' => 'Managing API Tokens with Passport',
                'slug' => 'managing-api-tokens-with-passport',
                'content' => "Learn how to manage personal access tokens and OAuth2 clients with Passport.\n\nPassport provides a complete OAuth2 server with personal access tokens, password grant tokens, and client credentials.\n\nYou'll learn:\n- Creating personal access tokens\n- Managing OAuth2 clients\n- Token scopes and abilities\n- Revoking tokens\n- Passport API routes",
                'order' => 2,
                'estimated_time' => 20,
            ]);
        }

        // Laravel Fortify Tutorials
        $fortify = Package::where('slug', 'laravel-fortify')->first();
        if ($fortify) {
            Tutorial::create([
                'package_id' => $fortify->id,
                'title' => 'Authentication with Fortify',
                'slug' => 'authentication-with-fortify',
                'content' => "Laravel Fortify is a frontend agnostic authentication backend for Laravel.\n\nFortify provides the backend implementation for authentication features including login, registration, email verification, and password reset.\n\nYou'll learn:\n- Installing and configuring Fortify\n- Customizing authentication views\n- Implementing two-factor authentication\n- Email verification\n- Password reset functionality",
                'order' => 1,
                'estimated_time' => 18,
            ]);

            Tutorial::create([
                'package_id' => $fortify->id,
                'title' => 'Two-Factor Authentication',
                'slug' => 'two-factor-authentication',
                'content' => "Implement two-factor authentication (2FA) using Laravel Fortify.\n\n2FA adds an extra layer of security to your application by requiring users to provide a second form of verification.\n\nYou'll learn:\n- Enabling two-factor authentication\n- Generating QR codes\n- Validating 2FA codes\n- Recovery codes\n- Customizing 2FA flow",
                'order' => 2,
                'estimated_time' => 22,
            ]);
        }

        // Laravel Pail Tutorials
        $pail = Package::where('slug', 'laravel-pail')->first();
        if ($pail) {
            Tutorial::create([
                'package_id' => $pail->id,
                'title' => 'Real-time Log Monitoring with Pail',
                'slug' => 'real-time-log-monitoring-with-pail',
                'content' => "Laravel Pail allows you to easily dive into your Laravel application's log files directly from the command line.\n\nPail provides a beautiful interface for viewing your application logs in real-time with syntax highlighting and filtering.\n\nYou'll learn:\n- Installing Laravel Pail\n- Viewing logs in real-time\n- Filtering logs by level\n- Searching log entries\n- Understanding log output",
                'order' => 1,
                'estimated_time' => 10,
            ]);

            Tutorial::create([
                'package_id' => $pail->id,
                'title' => 'Advanced Pail Filtering',
                'slug' => 'advanced-pail-filtering',
                'content' => "Master advanced filtering and searching techniques with Laravel Pail.\n\nPail provides powerful filtering options to help you find exactly what you're looking for in your logs.\n\nYou'll learn:\n- Filtering by log level (error, warning, info)\n- Searching log messages\n- Filtering by user or request\n- Using regular expressions\n- Combining multiple filters",
                'order' => 2,
                'estimated_time' => 12,
            ]);
        }
    }
}
