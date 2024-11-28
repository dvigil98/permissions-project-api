<?php

namespace App\Providers;

use App\Interfaces\IAuthRepository;
use App\Interfaces\IAuthService;
use App\Repositories\AuthRepository;
use App\Services\AuthService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->bind(IAuthRepository::class, AuthRepository::class);

        // Services
        $this->app->bind(IAuthService::class, AuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
