<?php

namespace Database\Seeders\CodeExamples;

use App\Models\CodeExample;
use App\Models\Tutorial;
use Illuminate\Database\Seeder;

class EloquentCodeExampleSeeder extends Seeder
{
    public function run(): void
    {
        // Eloquent Relationships (already has examples from original seeder)
        // Query Scopes and Accessors
        $tutorial = Tutorial::where('slug', 'query-scopes-and-accessors')->first();
        if ($tutorial) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Local Query Scopes',
                'description' => "**Scenario**: Filter active users and popular posts using reusable scopes.

**Use Case**: Instead of writing `where('active', true)` everywhere, use `active()` scope.

**Expected Behavior**: Cleaner, more readable queries",
                'code' => "<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // Local scope for active users
    public function scopeActive(\$query)
    {
        return \$query->where('active', true);
    }
    
    // Local scope for admins
    public function scopeAdmins(\$query)
    {
        return \$query->where('role', 'admin');
    }
}

// Usage
\$activeUsers = User::active()->get();
\$activeAdmins = User::active()->admins()->get();",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Accessors and Mutators',
                'description' => "**Scenario**: Format user names and encrypt passwords automatically.

**Input**: `\$user->first_name = 'john'`

**Expected Output**: `\$user->full_name` returns 'John Doe' (capitalized)",
                'code' => "<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // Accessor: Get full name
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => \$this->first_name . ' ' . \$this->last_name,
        );
    }
    
    // Accessor: Capitalize first name
    protected function firstName(): Attribute
    {
        return Attribute::make(
            get: fn (string \$value) => ucfirst(\$value),
            set: fn (string \$value) => strtolower(\$value),
        );
    }
}

// Usage
\$user = User::find(1);
echo \$user->full_name; // 'John Doe'
echo \$user->first_name; // 'John' (capitalized)",
                'language' => 'php',
                'order' => 2,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Attribute Casting',
                'description' => "**Scenario**: Automatically cast attributes to specific types.

**Use Case**: Convert JSON strings to arrays, dates to Carbon instances.

**Expected Behavior**: No manual conversion needed",
                'code' => "<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected \$casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        'metadata' => 'array',
        'views_count' => 'integer',
    ];
}

// Usage
\$post = Post::find(1);

// Automatically a Carbon instance
echo \$post->published_at->format('Y-m-d');

// Automatically a boolean
if (\$post->is_published) {
    // ...
}

// Automatically an array
\$meta = \$post->metadata;
echo \$meta['author'];",
                'language' => 'php',
                'order' => 3,
            ]);
        }
    }
}
