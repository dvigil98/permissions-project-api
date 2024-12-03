<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Interfaces\IUserRepository;
use App\Interfaces\IUserService;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{
    use ApiResponse;

    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers()
    {
        try {
            $users = $this->userRepository->getAll();

            return $this->ok(UserResource::collection($users));
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }

    public function saveUser($data)
    {
        try {
            $user = new User();
            $user->role_id = $data->role_id;
            $user->name = $data->name;
            $user->email = $data->email;
            $user->password = Hash::make($data->password);
            $user->active = 1;

            if ($this->userRepository->saveOrUpdate($user))
                return $this->created(new UserResource($user));

            return $this->badRequest(['Datos no guardados']);
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }

    public function getUser($id)
    {
        try {
            $user = $this->userRepository->getById($id);

            if (empty($user))
                return $this->notFound(['Datos no encontrados']);

            return $this->ok(new UserResource($user));
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }

    public function updateUser($data, $id)
    {
        try {
            $user = $this->userRepository->getById($id);

            if (empty($user))
                return $this->notFound(['Datos no encontrados']);

            $user->role_id = $data->role_id;
            $user->name = $data->name;
            $user->email = $data->email;
            if (!empty($data->password))
                $user->password = Hash::make($data->password);
            $user->active = $data->active;

            if ($this->userRepository->saveOrUpdate($user))
                return $this->ok(new UserResource($user));

            return $this->badRequest(['Datos no actualizados']);
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = $this->userRepository->getById($id);

            if (empty($user))
                return $this->notFound(['Datos no encontrados']);

            if ($this->userRepository->delete($user))
                return $this->ok();

            return $this->badRequest(['Datos no eliminados']);
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }

    public function searchUser($critery, $value)
    {
        try {
            $users = $this->userRepository->search($critery, $value);

            return $this->ok(UserResource::collection($users));
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }
}
