<?php

namespace App\Services;

use App\Http\Resources\AuthenticatedUserResource;
use App\Interfaces\IAuthRepository;
use App\Interfaces\IAuthService;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

class AuthService implements IAuthService
{
    use ApiResponse;

    private $authRepository;

    public function __construct(IAuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
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

            return $this->ok([
                'user' => new AuthenticatedUserResource($user),
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
