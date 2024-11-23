<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // İzinleri oluştur
        $permissions = [
            ['name' => 'create-report'],
            ['name' => 'edit-report'],
            ['name' => 'delete-report'],
            ['name' => 'create-post'],
            ['name' => 'edit-post'],
            ['name' => 'delete-post'],
            ['name' => 'create-role'],
            ['name' => 'edit-role'],
            ['name' => 'delete-role'],
            ['name' => 'create-permission'],
            ['name' => 'edit-permission'],
            ['name' => 'delete-permission'],
            ['name' => 'create-user'],
            ['name' => 'edit-user'],
            ['name' => 'delete-user'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                $permission
            );
        }

        // Rolleri oluştur
        $adminRole = Role::create(['name' => 'Admin']);
        $editorRole = Role::create(['name' => 'Editor']);
        $viewerRole = Role::create(['name' => 'Viewer']);

        // Kullanıcıları oluştur
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456'),
        ]);
        $admin->roles()->attach($adminRole->id);
        $admin->permissions()->attach(Permission::all()->pluck('id')->toArray()); // Tüm izinler

        $editor = User::create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'password' => Hash::make('123456'),
        ]);
        $editor->roles()->attach($editorRole->id);
        $editor->permissions()->attach([
            1, // create-report
            2, // edit-report
            4, // create-post
            5, // edit-post
        ]);

        $viewer = User::create([
            'name' => 'Viewer User',
            'email' => 'viewer@example.com',
            'password' => Hash::make('123456'),
        ]);
        $viewer->roles()->attach($viewerRole->id);
        $viewer->permissions()->attach([
            1, // create-report
            2, // edit-report
        ]);

        // Test kullanıcıları
        User::create([
            'name' => 'Test User 1',
            'email' => 'test1@example.com',
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'password' => Hash::make('123456'),
        ]);
    }
}
