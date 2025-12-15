<?php

namespace Database\Seeders;

use Database\Seeders\CodeExamples\SanctumCodeExampleSeeder;
use Database\Seeders\CodeExamples\EloquentCodeExampleSeeder;
use Database\Seeders\CodeExamples\ApiResourceCodeExampleSeeder;
use Database\Seeders\CodeExamples\MigrationCodeExampleSeeder;
use Database\Seeders\CodeExamples\TelescopeCodeExampleSeeder;
use Database\Seeders\CodeExamples\PestCodeExampleSeeder;
use Database\Seeders\CodeExamples\PassportCodeExampleSeeder;
use Database\Seeders\CodeExamples\FortifyCodeExampleSeeder;
use Database\Seeders\CodeExamples\PailCodeExampleSeeder;
use Illuminate\Database\Seeder;

class CodeExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * This seeder orchestrates all package-specific code example seeders
     * to achieve 100% tutorial coverage with comprehensive examples.
     */
    public function run(): void
    {
        $this->call([
            SanctumCodeExampleSeeder::class,
            EloquentCodeExampleSeeder::class,
            ApiResourceCodeExampleSeeder::class,
            MigrationCodeExampleSeeder::class,
            TelescopeCodeExampleSeeder::class,
            PestCodeExampleSeeder::class,
            PassportCodeExampleSeeder::class,
            FortifyCodeExampleSeeder::class,
            PailCodeExampleSeeder::class,
        ]);
    }
}
