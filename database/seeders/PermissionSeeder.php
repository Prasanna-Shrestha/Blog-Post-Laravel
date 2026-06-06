<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\User;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    $permissions = [
        ['name' => 'create-post',       'label' => 'Create Post'],
        ['name' => 'edit-own-post',      'label' => 'Edit Own Post'],
        ['name' => 'delete-own-post',    'label' => 'Delete Own Post'],
        ['name' => 'add-comment',        'label' => 'Add Comment'],
        ['name' => 'view-profile',       'label' => 'View Own Profile'],
        ['name' => 'manage-permissions', 'label' => 'Manage Permissions'],
    ];

    foreach ($permissions as $p) {
        Permission::firstOrCreate(['name' => $p['name']], ['label' => $p['label']]);
    }

    $allPermissionIds = Permission::all()->pluck('id');

    $defaultPermissionIds = Permission::whereIn('name', [
        'create-post',
        'edit-own-post',
        'delete-own-post',
        'add-comment',
        'view-profile',
    ])->pluck('id');

    $adminRole = Role::where('name', 'admin')->first();

    if ($adminRole) {
        $adminRole->users->each(function ($user) use ($allPermissionIds) {
            $user->permissions()->sync($allPermissionIds);
        });
    }
    User::whereDoesntHave('permissions')
        ->whereDoesntHave('roles', fn($q) => $q->where('name', 'admin'))
        ->each(function ($user) use ($defaultPermissionIds) {
            $user->permissions()->sync($defaultPermissionIds);
        });
}
}
