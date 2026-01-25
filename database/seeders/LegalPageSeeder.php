<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LegalPage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LegalPageSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure 'manage legal pages' permission exists
        if (!Permission::where('name', 'manage legal pages')->exists()) {
            Permission::create(['name' => 'manage legal pages']);
        }
        
        // Give permission to admin role if it exists
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminRole->givePermissionTo('manage legal pages');
        }

        // Get the first user (usually admin) to associate as creator
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);
            $user->assignRole('admin');
        }

        $pages = [
            [
                'slug' => 'privacy',
                'title' => 'Privacy Policy',
                'content' => '<h1>Privacy Policy</h1><p>This is the default privacy policy content. Please update it via the admin panel.</p>',
                'status' => 'published',
                'version' => 1,
                'published_at' => now(),
            ],
            [
                'slug' => 'terms-of-service',
                'title' => 'Terms of Service',
                'content' => '<h1>Terms of Service</h1><p>This is the default terms of service content. Please update it via the admin panel.</p>',
                'status' => 'published',
                'version' => 1,
                'published_at' => now(),
            ],
            [
                'slug' => 'starter-page',
                'title' => 'Starter Page',
                'content' => '<h1>Starter Page</h1><p>This is a starter page for testing purposes.</p>',
                'status' => 'published',
                'version' => 1,
                'published_at' => now(),
            ],
        ];

        foreach ($pages as $page) {
            if (!LegalPage::where('slug', $page['slug'])->exists()) {
                LegalPage::create(array_merge($page, [
                    'created_by' => $user->id,
                    'updated_by' => $user->id,
                ]));
            }
        }
    }
}
