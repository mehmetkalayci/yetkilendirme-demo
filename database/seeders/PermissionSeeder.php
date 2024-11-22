<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'create_posts']);
        Permission::create(['name' => 'edit_posts']);
        Permission::create(['name' => 'delete_posts']);
        Permission::create(['name' => 'view_posts']);
    }
} 