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

        return view('role.index', [
            'roles' => Role::all(),
            'permissions' => Permission::all(),
            'users' => User::all(),
        ]);
    }
}
