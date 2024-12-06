<?php

namespace App\Providers;

use App\Interfaces\IAuthRepository;
use App\Interfaces\IAuthService;
use App\Interfaces\ICommonRepository;
use App\Interfaces\ICommonService;
use App\Interfaces\IPermissionRepository;
use App\Interfaces\IPermissionService;
use App\Interfaces\IRolePermissionRepository;
use App\Interfaces\IRolePermissionService;
use App\Interfaces\IRoleRepository;
use App\Interfaces\IRoleService;
use App\Interfaces\IUserRepository;
use App\Interfaces\IUserService;
use App\Repositories\AuthRepository;
use App\Repositories\CommonRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RolePermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\CommonService;
use App\Services\PermissionService;
use App\Services\RolePermissionService;
use App\Services\RoleService;
use App\Services\UserService;
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
        $this->app->bind(IPermissionRepository::class, PermissionRepository::class);
        $this->app->bind(IRoleRepository::class, RoleRepository::class);
        $this->app->bind(IRolePermissionRepository::class, RolePermissionRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ICommonRepository::class, CommonRepository::class);

        // Services
        $this->app->bind(IAuthService::class, AuthService::class);
        $this->app->bind(IPermissionService::class, PermissionService::class);
        $this->app->bind(IRoleService::class, RoleService::class);
        $this->app->bind(IRolePermissionService::class, RolePermissionService::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(ICommonService::class, CommonService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
