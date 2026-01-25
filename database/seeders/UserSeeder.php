<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'manage users',
            'users.create',
            'users.edit',
            'users.delete',
            'manage landing',
            'manage about',
            'manage admissions',
            'manage academics',
            'manage facilities',
            'manage news',
            'manage events',
            'approve content', // For Admin/Editor
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $adminRole = Role::findOrCreate('admin', 'web');
        $editorRole = Role::findOrCreate('editor', 'web');
        $userRole = Role::findOrCreate('user', 'web');

        $adminRole->syncPermissions($permissions);

        $editorRole->syncPermissions([
            'manage news',
            'manage events',
            'manage landing',
            'manage about',
            'manage admissions',
            'manage academics',
            'manage facilities',
        ]);

        $userRole->syncPermissions([
            // Limited permissions if any
        ]);

        $adminEmail = env('ADMIN_EMAIL', 'admin@gmail.com');
        $adminPassword = env('ADMIN_PASSWORD', 'password');

        $admin = User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Admin',
                'password' => Hash::make($adminPassword),
            ]
        );
        $admin->syncRoles(['admin']);

        $editor = User::updateOrCreate(
            ['email' => 'editor@example.com'],
            [
                'name' => 'Editor',
                'password' => Hash::make('password'),
            ]
        );
        $editor->syncRoles(['editor']);

        $user = User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User',
                'password' => Hash::make('password'),
            ]
        );
        $user->syncRoles(['user']);
    }
}
