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
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $adminRole = Role::findOrCreate('admin', 'web');
        $userRole = Role::findOrCreate('user', 'web');

        $adminRole->syncPermissions($permissions);
        $userRole->syncPermissions([]);

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
