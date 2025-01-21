<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'deactivate users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'set moderator']);

        $adminRole = Role::create(['name' => 'admin']);
        $moderatorRole = Role::create(['name' => 'moderator']);
        $userRole = Role::create(['name' => 'user']);

        // Memberikan permissions kepada roles
        $adminRole->givePermissionTo(['view users', 'deactivate users', 'delete users', 'set moderator']);
        $moderatorRole->givePermissionTo(['view users', 'set moderator']);
        $userRole->givePermissionTo(['view users']);

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        $admin->assignRole('admin');

        $moderator = User::factory()->create([
            'name' => 'Moderator User',
            'email' => 'moderator@example.com',
        ]);
        $moderator->assignRole('moderator');

        $user = User::factory()->create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
        ]);
        $user->assignRole('user');
    }
}

