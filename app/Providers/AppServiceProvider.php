<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate as admin;

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
        admin::define('admin', function(User $user){
            return $user->role === 'admin';
        });
        view()->composer('*', function ($view) {
        $view->with('setting', Setting::first());
    });
    }
}
