<?php

namespace Database\Seeders\CodeExamples;

use App\Models\CodeExample;
use App\Models\Tutorial;
use Illuminate\Database\Seeder;

class PassportCodeExampleSeeder extends Seeder
{
    public function run(): void
    {
        // OAuth2 Server with Passport
        $tutorial = Tutorial::where('slug', 'oauth2-server-with-passport')->first();
        if ($tutorial) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Install Passport',
                'description' => "**Scenario**: Install Laravel Passport for OAuth2 server.

**Expected Output**: Passport installed with encryption keys generated",
                'code' => "# Install Passport
composer require laravel/passport

# Run migrations
php artisan migrate

# Generate encryption keys
php artisan passport:install

# Output:
# Encryption keys generated successfully.
# Personal access client created successfully.
# Password grant client created successfully.",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Configure Passport',
                'description' => "**Scenario**: Set up Passport in your application.

**Setup**: Add HasApiTokens trait and configure AuthServiceProvider",
                'code' => "<?php

// app/Models/User.php
namespace App\Models;

use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
}

// app/Providers/AuthServiceProvider.php
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
    }
}",
                'language' => 'php',
                'order' => 2,
            ]);
        }

        // Managing API Tokens with Passport
        $tutorial = Tutorial::where('slug', 'managing-api-tokens-with-passport')->first();
        if ($tutorial) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Create OAuth2 Client',
                'description' => "**Scenario**: Create OAuth2 client for third-party app.

**Expected Output**: Client ID and secret generated",
                'code' => "# Create password grant client
php artisan passport:client --password

# Output:
# What should we name the password grant client? [Laravel Password Grant Client]:
# > My Mobile App
#
# Password grant client created successfully.
# Client ID: 2
# Client secret: abc123xyz...",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Issue Access Token',
                'description' => "**Scenario**: User requests access token via OAuth2.

**Input (POST /oauth/token)**:
```json
{
  \"grant_type\": \"password\",
  \"client_id\": \"2\",
  \"client_secret\": \"abc123\",
  \"username\": \"john@example.com\",
  \"password\": \"secret\",
  \"scope\": \"\"
}
```

**Expected Output**: Access token and refresh token",
                'code' => "<?php

// Request token
\$response = Http::post('http://your-app.test/oauth/token', [
    'grant_type' => 'password',
    'client_id' => config('passport.password_client.id'),
    'client_secret' => config('passport.password_client.secret'),
    'username' => \$request->email,
    'password' => \$request->password,
    'scope' => '',
]);

// Response:
// {
//   \"token_type\": \"Bearer\",
//   \"expires_in\": 1296000,
//   \"access_token\": \"eyJ0eXAiOiJKV1QiLCJhbGc...\",
//   \"refresh_token\": \"def50200...\"
// }",
                'language' => 'php',
                'order' => 2,
            ]);
        }
    }
}
