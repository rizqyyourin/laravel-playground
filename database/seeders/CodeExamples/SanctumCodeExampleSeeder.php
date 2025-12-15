<?php

namespace Database\Seeders\CodeExamples;

use App\Models\CodeExample;
use App\Models\Tutorial;
use Illuminate\Database\Seeder;

class SanctumCodeExampleSeeder extends Seeder
{
    public function run(): void
    {
        // Getting Started with Sanctum
        $tutorial = Tutorial::where('slug', 'getting-started-with-sanctum')->first();
        if ($tutorial) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Install Sanctum',
                'description' => "**Scenario**: Install Laravel Sanctum in your Laravel application.

**Step 1**: Install via Composer

**Step 2**: Publish configuration

**Expected Output**: Sanctum installed and configured successfully",
                'code' => "# Install Sanctum
composer require laravel/sanctum

# Publish configuration
php artisan vendor:publish --provider=\"Laravel\Sanctum\SanctumServiceProvider\"

# Run migrations
php artisan migrate",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Add HasApiTokens Trait',
                'description' => "**Scenario**: Enable API token authentication for User model.

**Setup**: Add the HasApiTokens trait to your User model.

**Expected Behavior**: Users can now create and manage API tokens",
                'code' => "<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;

    // ... rest of your model
}",
                'language' => 'php',
                'order' => 2,
            ]);
        }

        // Issuing API Tokens (already has examples from original seeder)
        $tutorial = Tutorial::where('slug', 'issuing-api-tokens')->first();
        if ($tutorial && $tutorial->codeExamples()->count() == 0) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Login and Issue Token',
                'description' => "**Scenario**: User logs in via API and receives a token.

**Input (POST /api/login)**:
```json
{
  \"email\": \"john@example.com\",
  \"password\": \"secret123\"
}
```

**Expected Output (Success)**:
```json
{
  \"user\": {
    \"id\": 1,
    \"name\": \"John Doe\",
    \"email\": \"john@example.com\"
  },
  \"token\": \"1|abc123xyz...\"
}
```",
                'code' => "<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request \$request)
    {
        \$request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        \$user = User::where('email', \$request->email)->first();

        if (!\$user || !Hash::check(\$request->password, \$user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        \$token = \$user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => \$user,
            'token' => \$token
        ]);
    }
}",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Token with Abilities',
                'description' => "**Scenario**: Create tokens with specific permissions.

**Use Case**: Mobile app can only read posts, but admin can do everything.

**Example Abilities**:
- `posts:read` - Can view posts
- `posts:create` - Can create posts
- `*` - All abilities (admin)",
                'code' => "<?php

// Mobile app token (limited permissions)
\$token = \$user->createToken('mobile-app', [
    'posts:read',
    'posts:create'
])->plainTextToken;

// Admin token (all permissions)
\$adminToken = \$admin->createToken('admin-token', ['*'])->plainTextToken;

// Check abilities in controller
if (\$request->user()->tokenCan('posts:create')) {
    // User can create posts
    Post::create([...]);
}",
                'language' => 'php',
                'order' => 2,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Using Token in Frontend',
                'description' => "**Scenario**: Frontend app makes authenticated API requests.

**Step 1**: Store token after login
**Step 2**: Include token in all API requests
**Step 3**: Handle logout",
                'code' => "// Step 1: Login and store token
fetch('/api/login', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify({
        email: 'john@example.com',
        password: 'secret123'
    })
})
.then(response => response.json())
.then(data => {
    localStorage.setItem('api_token', data.token);
});

// Step 2: Make authenticated requests
const token = localStorage.getItem('api_token');
fetch('/api/user', {
    headers: {
        'Authorization': `Bearer \${token}`,
        'Accept': 'application/json',
    }
})
.then(response => response.json())
.then(data => console.log(data));

// Step 3: Logout
fetch('/api/logout', {
    method: 'POST',
    headers: {
        'Authorization': `Bearer \${token}`,
    }
})
.then(() => localStorage.removeItem('api_token'));",
                'language' => 'javascript',
                'order' => 3,
            ]);
        }

        // Protecting Routes with Sanctum
        $tutorial = Tutorial::where('slug', 'protecting-routes-with-sanctum')->first();
        if ($tutorial) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Protect API Routes',
                'description' => "**Scenario**: Protect your API routes with Sanctum middleware.

**Setup**: Use `auth:sanctum` middleware on routes that require authentication.

**Expected Behavior**: Only authenticated users with valid tokens can access protected routes",
                'code' => "<?php

use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request \$request) {
        return \$request->user();
    });
    
    Route::apiResource('posts', PostController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Access Authenticated User',
                'description' => "**Scenario**: Get the currently authenticated user in your controller.

**Input**: Authenticated request with valid token

**Expected Output**: User object with all user data",
                'code' => "<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request \$request)
    {
        // Get authenticated user
        \$user = \$request->user();
        
        return response()->json([
            'user' => \$user
        ]);
    }
    
    public function update(Request \$request)
    {
        \$validated = \$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);
        
        \$request->user()->update(\$validated);
        
        return response()->json([
            'message' => 'Profile updated',
            'user' => \$request->user()
        ]);
    }
}",
                'language' => 'php',
                'order' => 2,
            ]);
        }
    }
}
