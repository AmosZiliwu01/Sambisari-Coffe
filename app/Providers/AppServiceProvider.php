<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
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
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Gate::define('admin', function (User $user){
            return $user->role === 'admin';
        });
        Gate::define('pelanggan', function (User $user){
            return $user->role === 'pelanggan' || $user->role === 'admin';
        });
        Gate::define('kasir', function (User $user){
            return $user->role === 'kasir' || $user->role === 'admin';
        });
        Gate::define('pelanggan', function (User $user){
            return $user->role === 'kasir' || $user->role === 'kasir';
        });
        Gate::define('adminOrKasir', function (User $user) {
            return $user->role === 'admin' || $user->role === 'kasir';
        });
        Gate::define('pelangganOrKasir', function (User $user){
            return $user->role === 'kasir' || $user->role === 'pelanggan';
        });
        Gate::define('pelangganR', function (User $user){
            return $user->role === 'pelanggan' || $user->role === 'pelanggan';
        });

    }
}
