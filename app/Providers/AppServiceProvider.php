<?php

namespace App\Providers;

use App\Contracts\Admin;
use App\Contracts\Auth;
use App\Contracts\User;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LoginController;
use App\Services\AdminServices;
use App\Services\AuthServices;
use App\Services\ClienteServices;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->when(LoginController::class)
        ->needs(Auth::class)
        ->give(AuthServices::class);

        $this->app->when(ClienteController::class)
        ->needs(User::class)
        ->give(ClienteServices::class);

        $this->app->when(AdminController::class)
        ->needs(Admin::class)
        ->give(AdminServices::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
