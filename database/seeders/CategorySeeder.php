<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Authentication & Authorization',
                'slug' => 'authentication-authorization',
                'description' => 'Packages for user authentication, authorization, and access control',
                'icon' => '🔐',
                'order' => 1,
            ],
            [
                'name' => 'API Development',
                'slug' => 'api-development',
                'description' => 'Tools and packages for building RESTful APIs and GraphQL endpoints',
                'icon' => '🌐',
                'order' => 2,
            ],
            [
                'name' => 'Database & ORM',
                'slug' => 'database-orm',
                'description' => 'Database management, migrations, and Eloquent ORM features',
                'icon' => '🗄️',
                'order' => 3,
            ],
            [
                'name' => 'Testing & Debugging',
                'slug' => 'testing-debugging',
                'description' => 'Testing frameworks, debugging tools, and quality assurance packages',
                'icon' => '🧪',
                'order' => 4,
            ],
            [
                'name' => 'Queue & Jobs',
                'slug' => 'queue-jobs',
                'description' => 'Background job processing, queue management, and task scheduling',
                'icon' => '⚙️',
                'order' => 5,
            ],
            [
                'name' => 'File Storage & Media',
                'slug' => 'file-storage-media',
                'description' => 'File uploads, cloud storage integration, and media management',
                'icon' => '📁',
                'order' => 6,
            ],
            [
                'name' => 'Email & Notifications',
                'slug' => 'email-notifications',
                'description' => 'Email sending, notification systems, and messaging services',
                'icon' => '📧',
                'order' => 7,
            ],
            [
                'name' => 'Payment & E-commerce',
                'slug' => 'payment-ecommerce',
                'description' => 'Payment gateway integration and e-commerce solutions',
                'icon' => '💳',
                'order' => 8,
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
