<?php

namespace Database\Seeders\CodeExamples;

use App\Models\CodeExample;
use App\Models\Tutorial;
use Illuminate\Database\Seeder;

class PailCodeExampleSeeder extends Seeder
{
    public function run(): void
    {
        // Real-time Log Monitoring with Pail
        $tutorial = Tutorial::where('slug', 'real-time-log-monitoring-with-pail')->first();
        if ($tutorial) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Install and Run Pail',
                'description' => "**Scenario**: Monitor application logs in real-time.

**Expected Output**: Live log stream in terminal with syntax highlighting",
                'code' => "# Install Pail
composer require laravel/pail

# Run Pail
php artisan pail

# Output (live stream):
# [2024-01-15 10:30:45] local.INFO: User logged in {\"user_id\":1}
# [2024-01-15 10:30:46] local.DEBUG: Cache hit {\"key\":\"users.1\"}
# [2024-01-15 10:30:47] local.ERROR: Payment failed {\"order_id\":123}",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Basic Filtering',
                'description' => "**Scenario**: Filter logs by level (error, warning, info).

**Expected Output**: Only logs matching the filter are displayed",
                'code' => "# Show only errors
php artisan pail --filter=error

# Show errors and warnings
php artisan pail --filter=error,warning

# Show specific log level
php artisan pail --level=debug

# Output:
# [2024-01-15 10:30:47] local.ERROR: Payment failed
# [2024-01-15 10:31:02] local.ERROR: Database connection lost",
                'language' => 'php',
                'order' => 2,
            ]);
        }

        // Advanced Pail Filtering
        $tutorial = Tutorial::where('slug', 'advanced-pail-filtering')->first();
        if ($tutorial) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Search Log Messages',
                'description' => "**Scenario**: Search for specific text in log messages.

**Use Case**: Find all logs related to \"payment\" or specific user

**Expected Output**: Only matching logs displayed",
                'code' => "# Search for specific text
php artisan pail --message=\"payment\"

# Search for user-related logs
php artisan pail --message=\"user_id:123\"

# Combine with level filter
php artisan pail --filter=error --message=\"database\"

# Output:
# [2024-01-15 10:30:47] local.ERROR: Payment failed {\"order_id\":123}
# [2024-01-15 10:35:12] local.ERROR: Payment gateway timeout",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Filter by User or Request',
                'description' => "**Scenario**: Monitor logs for specific user or request.

**Use Case**: Debug issues for a specific user session

**Expected Output**: Logs filtered by user ID or request ID",
                'code' => "# Filter by user
php artisan pail --user=1

# Filter by request ID
php artisan pail --request=abc123

# Combine multiple filters
php artisan pail --user=1 --filter=error

# Use regex pattern
php artisan pail --message=\"/user_id:[0-9]+/\"

# Output:
# [2024-01-15 10:30:45] local.INFO: User logged in {\"user_id\":1}
# [2024-01-15 10:30:50] local.DEBUG: User viewed profile {\"user_id\":1}",
                'language' => 'php',
                'order' => 2,
            ]);
        }
    }
}
