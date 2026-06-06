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
                    return $user->hasPermission($permission->name);
                });
            });
            Gate::define('manage-users', function ($user){
                return $user->isAdmin();
            });
        } catch (\Exception $e) {
            // Silently fail during migrations / before DB is ready
        }  
    }
}
