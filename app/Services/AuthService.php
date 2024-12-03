<?php

namespace App\Services;

use App\Http\Resources\AuthenticatedUserResource;
use App\Http\Resources\RolePermissionResource;
use App\Interfaces\IAuthRepository;
use App\Interfaces\IAuthService;
use App\Interfaces\IRolePermissionRepository;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class AuthService implements IAuthService
{
    use ApiResponse;

    private $authRepository;
    private $rolePermissionRepository;

    public function __construct(
        IAuthRepository $authRepository,
        IRolePermissionRepository $rolePermissionRepository
    ) {
        $this->authRepository = $authRepository;
        $this->rolePermissionRepository = $rolePermissionRepository;
    }

    public function login($email, $password)
    {
        try {
            $user = $this->authRepository->getUserByEmail($email);

            if (empty($user))
                return $this->unauthorized(['Usuario no existe']);

            if (!$user->active)
                return $this->unauthorized(['Usuario desactivado']);

            $token = Auth::attempt(['email' => $email, 'password' => $password]);

            if (!$token)
                return $this->unauthorized(['Credenciales inválidas']);

            $rolePermissions = $this->rolePermissionRepository->getRolePermissionsByRole($user->role->id);

            return $this->ok([
                'user' => new AuthenticatedUserResource($user),
                'role_permissions' => RolePermissionResource::collection($rolePermissions),
                'token_type' => 'Bearer',
                'access_token' => $token
            ]);
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }

    public function logout()
    {
        try {
            Auth::logout();

            return $this->ok();
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }
}
