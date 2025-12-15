<?php

namespace Database\Seeders\CodeExamples;

use App\Models\CodeExample;
use App\Models\Tutorial;
use Illuminate\Database\Seeder;

class MigrationCodeExampleSeeder extends Seeder
{
    public function run(): void
    {
        // Creating Your First Migration
        $tutorial = Tutorial::where('slug', 'creating-your-first-migration')->first();
        if ($tutorial) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Create Migration File',
                'description' => "**Scenario**: Create a migration for a `posts` table.

**Step 1**: Generate migration file

**Expected Output**: Migration file created in `database/migrations/`",
                'code' => "# Create migration
php artisan make:migration create_posts_table

# Output:
# Created Migration: 2024_01_15_100000_create_posts_table",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Define Table Schema',
                'description' => "**Scenario**: Define columns for posts table.

**Columns**: id, title, content, user_id, published_at, timestamps

**Expected Behavior**: Table created with all specified columns",
                'code' => "<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint \$table) {
            \$table->id();
            \$table->foreignId('user_id')->constrained()->onDelete('cascade');
            \$table->string('title');
            \$table->text('content');
            \$table->timestamp('published_at')->nullable();
            \$table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};",
                'language' => 'php',
                'order' => 2,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Run Migration',
                'description' => "**Scenario**: Execute the migration to create the table.

**Expected Output**: Table created in database",
                'code' => "# Run all pending migrations
php artisan migrate

# Output:
# Migrating: 2024_01_15_100000_create_posts_table
# Migrated:  2024_01_15_100000_create_posts_table (45.23ms)

# Rollback last migration
php artisan migrate:rollback

# Rollback all migrations
php artisan migrate:reset

# Rollback and re-run all migrations
php artisan migrate:refresh",
                'language' => 'php',
                'order' => 3,
            ]);
        }

        // Modifying Existing Tables
        $tutorial = Tutorial::where('slug', 'modifying-existing-tables')->first();
        if ($tutorial) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Add New Column',
                'description' => "**Scenario**: Add `slug` column to existing `posts` table.

**Expected Behavior**: New column added without losing existing data",
                'code' => "<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint \$table) {
            \$table->string('slug')->unique()->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint \$table) {
            \$table->dropColumn('slug');
        });
    }
};",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Modify Column Type',
                'description' => "**Scenario**: Change `content` from TEXT to LONGTEXT.

**Expected Behavior**: Column type changed, data preserved",
                'code' => "<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint \$table) {
            \$table->longText('content')->change();
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint \$table) {
            \$table->text('content')->change();
        });
    }
};",
                'language' => 'php',
                'order' => 2,
            ]);
        }
    }
}
