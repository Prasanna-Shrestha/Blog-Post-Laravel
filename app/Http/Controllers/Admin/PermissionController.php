<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $roles       = Role::with('permissions')->get();
        $permissions = Permission::all();

        return view('admin.permissions', compact('roles', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'permissions'   => 'nullable|array',
            'permissions.*' => 'integer|exists:permissions,id',
        ]);

        $role->permissions()->sync($request->input('permissions', []));

        return back()->with('success', "Permissions for \"{$role->name->value}\" updated.");
    }
}