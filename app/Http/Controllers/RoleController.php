<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        // $adminRole = Role::create(['name' => 'admin']);
        // $auditorRole = Role::create(['name' => 'auditor']);
        // $permission = Permission::create(['name' => 'assign tasks']);
        // $role = Role::find(1);
        // $permission = Permission::find(1);
        // dd($role->permissions);
        // $role->givePermissionTo($permission);
        $user = User::find(1);
        dd($user->getPermissionsViaRoles());
        // $user->assignRole($role);

        // dd($user);
    }
}
