<?php

namespace Database\Seeders\CodeExamples;

use App\Models\CodeExample;
use App\Models\Tutorial;
use Illuminate\Database\Seeder;

class FortifyCodeExampleSeeder extends Seeder
{
    public function run(): void
    {
        // Authentication with Fortify
        $tutorial = Tutorial::where('slug', 'authentication-with-fortify')->first();
        if ($tutorial) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Install Fortify',
                'description' => "**Scenario**: Install Laravel Fortify for authentication.

**Expected Output**: Fortify installed and configured",
                'code' => "# Install Fortify
composer require laravel/fortify

# Publish configuration and views
php artisan vendor:publish --provider=\"Laravel\Fortify\FortifyServiceProvider\"

# Run migrations
php artisan migrate",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Configure Fortify Features',
                'description' => "**Scenario**: Enable registration, password reset, and email verification.

**Expected Behavior**: Features enabled in Fortify config",
                'code' => "<?php

// config/fortify.php

return [
    'features' => [
        Features::registration(),
        Features::resetPasswords(),
        Features::emailVerification(),
        Features::updateProfileInformation(),
        Features::updatePasswords(),
        Features::twoFactorAuthentication([
            'confirm' => true,
            'confirmPassword' => true,
        ]),
    ],
];",
                'language' => 'php',
                'order' => 2,
            ]);
        }

        // Two-Factor Authentication
        $tutorial = Tutorial::where('slug', 'two-factor-authentication')->first();
        if ($tutorial) {
            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Enable 2FA for User',
                'description' => "**Scenario**: User enables two-factor authentication.

**Expected Output**: QR code generated, recovery codes provided",
                'code' => "<?php

use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;

// Enable 2FA
\$user = auth()->user();
app(EnableTwoFactorAuthentication::class)(\$user);

// Get QR code
\$qrCode = \$user->twoFactorQrCodeSvg();

// Get recovery codes
\$recoveryCodes = json_decode(decrypt(\$user->two_factor_recovery_codes));

// Display to user:
// - QR code for scanning
// - Recovery codes for backup",
                'language' => 'php',
                'order' => 1,
            ]);

            CodeExample::create([
                'tutorial_id' => $tutorial->id,
                'title' => 'Verify 2FA Code',
                'description' => "**Scenario**: User logs in with 2FA code.

**Input**: 6-digit code from authenticator app

**Expected Output**: User authenticated successfully",
                'code' => "<?php

// routes/web.php
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;

Route::post('/two-factor-challenge', [
    TwoFactorAuthenticatedSessionController::class,
    'store'
]);

// User submits code:
// POST /two-factor-challenge
// {
//   \"code\": \"123456\"
// }

// Or recovery code:
// {
//   \"recovery_code\": \"abc-def-ghi\"
// }",
                'language' => 'php',
                'order' => 2,
            ]);
        }
    }
}
