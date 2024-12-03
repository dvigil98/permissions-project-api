<?php

namespace App\Http\Middleware;

use Closure;
use App\Interfaces\IRolePermissionRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    use ApiResponse;

    private $rolePermissionRepository;

    public function __construct(IRolePermissionRepository $rolePermissionRepository)
    {
        $this->rolePermissionRepository = $rolePermissionRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        $user = auth()->user();

        $rolePermissions = $this->rolePermissionRepository->getRolePermissionsByRole($user->role->id);

        $hasPermission = false;

        foreach ($rolePermissions as $rolePermission) {
            if ($rolePermission->permission->code == $permission && $rolePermission->active)
                $hasPermission = true;
        }

        if ($hasPermission)
            return $next($request);

        return $this->forbidden(['No cuentas con permisos para esta acción']);
    }
}
