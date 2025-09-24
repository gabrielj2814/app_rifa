<?php

namespace App\Providers;

use App\Contracts\Auth;
use App\Http\Controllers\LoginController;
use App\Services\AuthServices;
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

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
