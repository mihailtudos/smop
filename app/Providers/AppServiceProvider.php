<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Gate::define('manage-users', function ($user){
            return $user->hasAnyRoles(['admin']);
        });

        Gate::define('admin', function ($user){
            return $user->hasAnyRoles(['admin']);
        });

        Gate::define('supervise', function ($user){
            return $user->hasAnyRoles(['supervisor']);
        });

        Gate::define('manage-action', function ($user){
            return $user->hasAnyRoles(['admin']);
        });

        Gate::define('manage-projects', function ($user){
            return $user->hasAnyRoles(['admin', 'supervisor']);
        });

        Gate::define('edit-users', function ($user){
            return $user->hasAnyRoles(['admin', 'supervisor']);
        });

        Gate::define('delete-users', function ($user){
            return $user->hasRole('admin');

        });

        Gate::define('student', function ($user){
            return $user->hasAnyRoles(['student']);
        });
    }
}
