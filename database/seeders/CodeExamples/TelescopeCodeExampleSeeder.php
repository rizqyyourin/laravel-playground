<?php

namespace Database\Seeders\CodeExamples;

use App\Models\CodeExample;
use App\Models\Tutorial;
use Illuminate\Database\Seeder;

class TelescopeCodeExampleSeeder extends Seeder
{
    public function run(): void
    {
        // Getting Started with Telescope
        $tutorial = Tutorial::where('slug', 'getting-started-with-telescope')->first();
        if ($tutorial) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Install Telescope',
                'description' => "**Scenario**: Install Laravel Telescope for debugging.

**Expected Output**: Telescope installed and accessible at `/telescope`",
                'code' => "# Install Telescope
composer require laravel/telescope

# Publish assets and configuration
php artisan telescope:install

# Run migrations
php artisan migrate",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Access Telescope Dashboard',
                'description' => "**Scenario**: View Telescope dashboard in browser.

**URL**: `http://your-app.test/telescope`

**Expected Behavior**: See requests, queries, exceptions, and more",
                'code' => "<?php

// config/telescope.php

return [
    'enabled' => env('TELESCOPE_ENABLED', true),
    
    'path' => env('TELESCOPE_PATH', 'telescope'),
    
    'storage' => [
        'database' => [
            'connection' => env('DB_CONNECTION', 'mysql'),
            'chunk' => 1000,
        ],
    ],
    
    'watchers' => [
        Watchers\QueryWatcher::class => env('TELESCOPE_QUERY_WATCHER', true),
        Watchers\RequestWatcher::class => env('TELESCOPE_REQUEST_WATCHER', true),
        // ... more watchers
    ],
];",
                'language' => 'php',
                'order' => 2,
            ]);
        }

        // Debugging with Telescope
        $tutorial = Tutorial::where('slug', 'debugging-with-telescope')->first();
        if ($tutorial) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Monitor Database Queries',
                'description' => "**Scenario**: Identify N+1 query problems.

**Use Case**: Find slow queries and optimize them.

**Expected Output**: List of all queries with execution time",
                'code' => "<?php

// Example: N+1 Problem
\$posts = Post::all(); // 1 query
foreach (\$posts as \$post) {
    echo \$post->user->name; // N queries (1 per post)
}

// Solution: Eager Loading
\$posts = Post::with('user')->get(); // 2 queries total

// Telescope will show:
// - Query count
// - Execution time
// - Duplicate queries
// - Slow queries (> 100ms)",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Track Exceptions',
                'description' => "**Scenario**: Monitor and debug application exceptions.

**Expected Behavior**: See all exceptions with stack traces in Telescope",
                'code' => "<?php

// Telescope automatically captures exceptions

try {
    \$user = User::findOrFail(999);
} catch (\Exception \$e) {
    // Exception logged in Telescope
    // Shows:
    // - Exception type
    // - Message
    // - Stack trace
    // - Request context
    // - User info
}

// View in Telescope:
// /telescope/exceptions",
                'language' => 'php',
                'order' => 2,
            ]);
        }
    }
}
