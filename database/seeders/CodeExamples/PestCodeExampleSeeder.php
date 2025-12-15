<?php

namespace Database\Seeders\CodeExamples;

use App\Models\CodeExample;
use App\Models\Tutorial;
use Illuminate\Database\Seeder;

class PestCodeExampleSeeder extends Seeder
{
    public function run(): void
    {
        // Introduction to Pest Testing
        $tutorial = Tutorial::where('slug', 'introduction-to-pest-testing')->first();
        if ($tutorial) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Install Pest',
                'description' => "**Scenario**: Install Pest in Laravel application.

**Expected Output**: Pest installed and ready to use",
                'code' => "# Install Pest
composer require pestphp/pest --dev
composer require pestphp/pest-plugin-laravel --dev

# Initialize Pest
./vendor/bin/pest --init

# Run tests
./vendor/bin/pest",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Write Your First Test',
                'description' => "**Scenario**: Test that homepage returns 200 status.

**Expected Output**: Test passes ✓",
                'code' => "<?php

// tests/Feature/HomepageTest.php

test('homepage loads successfully', function () {
    \$response = \$this->get('/');
    
    \$response->assertStatus(200);
});

test('homepage contains welcome text', function () {
    \$response = \$this->get('/');
    
    \$response->assertSee('Welcome');
});",
                'language' => 'php',
                'order' => 2,
            ]);
        }

        // Testing Laravel Features with Pest
        $tutorial = Tutorial::where('slug', 'testing-laravel-features-with-pest')->first();
        if ($tutorial) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Test API Endpoints',
                'description' => "**Scenario**: Test POST /api/posts endpoint.

**Input**: Post data
**Expected Output**: 201 Created, post saved to database",
                'code' => "<?php

use App\Models\User;
use App\Models\Post;

test('user can create a post', function () {
    \$user = User::factory()->create();
    
    \$response = \$this->actingAs(\$user)->postJson('/api/posts', [
        'title' => 'My First Post',
        'content' => 'This is the content',
    ]);
    
    \$response->assertStatus(201);
    \$this->assertDatabaseHas('posts', [
        'title' => 'My First Post',
        'user_id' => \$user->id,
    ]);
});",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Test with Datasets',
                'description' => "**Scenario**: Test multiple scenarios with different data.

**Use Case**: Test validation with various inputs",
                'code' => "<?php

use App\Models\User;

test('post validation fails with invalid data', function (\$title, \$content) {
    \$user = User::factory()->create();
    
    \$response = \$this->actingAs(\$user)->postJson('/api/posts', [
        'title' => \$title,
        'content' => \$content,
    ]);
    
    \$response->assertStatus(422);
})->with([
    ['', 'Valid content'], // Empty title
    ['Valid title', ''], // Empty content
    [str_repeat('a', 300), 'Valid content'], // Title too long
]);",
                'language' => 'php',
                'order' => 2,
            ]);
        }
    }
}
