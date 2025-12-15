<?php

namespace Database\Seeders\CodeExamples;

use App\Models\CodeExample;
use App\Models\Tutorial;
use Illuminate\Database\Seeder;

class ApiResourceCodeExampleSeeder extends Seeder
{
    public function run(): void
    {
        // Resource Collections
        $tutorial = Tutorial::where('slug', 'resource-collections')->first();
        if ($tutorial) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Create Resource Collection',
                'description' => "**Scenario**: Return paginated list of posts with metadata.

**Expected Output**:
```json
{
  \"data\": [...],
  \"links\": {...},
  \"meta\": {\"total\": 50}
}
```",
                'code' => "<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    public function toArray(\$request)
    {
        return [
            'data' => \$this->collection,
            'meta' => [
                'total_posts' => \$this->collection->count(),
                'author_count' => \$this->collection->unique('user_id')->count(),
            ],
        ];
    }
}

// Usage in controller
public function index()
{
    \$posts = Post::with('user')->paginate(15);
    return new PostCollection(\$posts);
}",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Customize Pagination Wrapper',
                'description' => "**Scenario**: Customize the pagination wrapper keys.

**Default**: `data`, `links`, `meta`
**Custom**: `items`, `pagination`",
                'code' => "<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    public \$collects = PostResource::class;
    
    public function toArray(\$request)
    {
        return [
            'items' => \$this->collection,
            'pagination' => [
                'total' => \$this->total(),
                'count' => \$this->count(),
                'per_page' => \$this->perPage(),
                'current_page' => \$this->currentPage(),
                'total_pages' => \$this->lastPage(),
            ],
        ];
    }
}",
                'language' => 'php',
                'order' => 2,
            ]);
        }
    }
}
