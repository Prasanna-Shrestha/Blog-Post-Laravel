<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    public function boot(){
        try {
            Permission::with('roles')->get()->each(function ($permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    if (!$user->relationLoaded('roles')) {
                        $user->load('roles.permissions');
                    } elseif ($user->roles->isNotEmpty() && !$user->roles->first()->relationLoaded('permissions')) {
                        $user->load('roles.permissions');
                    }
                    return $user->hasPermission($permission->name);
                });
            });
        } catch (\Exception $e) {
            // Silently fail during migrations / before DB is ready
        }  
    }
}
