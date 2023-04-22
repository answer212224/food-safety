<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // User Model
        Permission::create(['name' => 'create: users']);
        Permission::create(['name' => 'read: users']);
        Permission::create(['name' => 'update: users']);
        Permission::create(['name' => 'delete: users']);

        // Role Model
        Permission::create(['name' => 'create: roles']);
        Permission::create(['name' => 'read: roles']);
        Permission::create(['name' => 'update: roles']);
        Permission::create(['name' => 'delete: roles']);

        // Permission Model
        Permission::create(['name' => 'create: permissions']);
        Permission::create(['name' => 'read: permissions']);
        Permission::create(['name' => 'update: permissions']);
        Permission::create(['name' => 'delete: permissions']);

        // Task Model
        Permission::create(['name' => 'create: tasks']);
        Permission::create(['name' => 'read: tasks']);
        Permission::create(['name' => 'update: tasks']);
        Permission::create(['name' => 'delete: tasks']);

        // Create Super-Admin Role
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        $superAdmin = Role::create(['name' => 'super-admin']);

        $superAdmin->givePermissionTo(Permission::all());

        // Create Admin Role
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'create: users',
            'read: users',
            'update: users',
            'delete: users',
            'create: tasks',
            'read: tasks',
            'update: tasks',
            'delete: tasks',
        ]);

        // Create Auditor Role
        $auditor = Role::create(['name' => 'auditor']);
        $auditor->givePermissionTo('read: tasks');

        // Create Users and Assign Roles
        $user = \App\Models\User::factory()->create([
            'name' => 'auditor',
            'email' => 'auditor@example.com',
        ]);
        $user->assignRole($auditor);

        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($admin);

        $user = \App\Models\User::factory()->create([
            'name' => 'super-admin',
            'email' => 'super-admin@example.com',
        ]);
        $user->assignRole($superAdmin);
    }
}
