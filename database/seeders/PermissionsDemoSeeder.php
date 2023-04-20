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

        // create permissions
        Permission::create(['name' => 'assign tasks']);
        Permission::create(['name' => 'unassign tasks']);
        Permission::create(['name' => 'perform tasks']);
        Permission::create(['name' => 'edit tasks']);
        Permission::create(['name' => 'delete tasks']);
        Permission::create(['name' => 'view own tasks']);
        Permission::create(['name' => 'view all tasks']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'edit permissions']);
        Permission::create(['name' => 'view all users']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'user']);
        $role1->givePermissionTo('view own tasks');
        $role1->givePermissionTo('perform tasks');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('assign tasks');
        $role2->givePermissionTo('unassign tasks');
        $role2->givePermissionTo('edit tasks');
        $role2->givePermissionTo('delete tasks');
        $role2->givePermissionTo('view all users');


        $role3 = Role::create(['name' => 'Super-Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Example User',
            'email' => 'user@example.com',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Admin User',
            'email' => 'admin@example.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@example.com',
        ]);
        $user->assignRole($role3);
    }
}
