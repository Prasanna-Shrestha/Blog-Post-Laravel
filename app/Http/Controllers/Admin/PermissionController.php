<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function users()
    {
        $users = User::paginate(10);

        return view('userpermission', compact('users'));
    }

    public function edit(User $user)
    {
        $permissions        = Permission::orderBy('name')->get();
        $userPermissions    = $user->permissions->pluck('id')->toArray();  // currently assigned
        $rolePermissions    = $user->roles
                                ->flatMap(fn($r) => $r->permissions)
                                ->pluck('id')
                                ->toArray();  // inherited from role

        return view('userpermissionedit', compact(
            'user',
            'permissions',
            'userPermissions',
            'rolePermissions'
        ));
    }

    public function update(Request $request, User $user)
    {
        $user->permissions()->sync(
            $request->permissions ?? []
        );

        return redirect()
            ->route(
                'admin.users.permissions.edit',
                $user
            )
            ->with(
                'success',
                'Permissions updated successfully.'
            );
    }
}