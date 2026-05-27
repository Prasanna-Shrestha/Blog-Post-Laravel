<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
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
            ['name' => 'edit-any-post',      'label' => 'Edit Any Post'],
            ['name' => 'delete-own-post',    'label' => 'Delete Own Post'],
            ['name' => 'delete-any-post',    'label' => 'Delete Any Post'],
            ['name' => 'add-comment',        'label' => 'Add Comment'],
            ['name' => 'view-profile',       'label' => 'View Own Profile'],
            ['name' => 'manage-permissions', 'label' => 'Manage Permissions'],
        ];

        foreach ($permissions as $p) {
            Permission::firstOrCreate(['name' => $p['name']], ['label' => $p['label']]);
        }

        $admin = Role::where('name', 'admin')->first();
        $user  = Role::where('name', 'user')->first();

        // Admin gets all permissions
        $admin->permissions()->sync(Permission::all()->pluck('id'));

        // User gets limited set
        $user->permissions()->sync(
            Permission::whereIn('name', [
                'create-post',
                'edit-own-post',
                'delete-own-post',
                'add-comment',
                'view-profile',
            ])->pluck('id')
        );
    }
}
