<?php

namespace App\Services;

use App\Http\Resources\RoleResource;
use App\Interfaces\IPermissionRepository;
use App\Interfaces\IRolePermissionRepository;
use App\Interfaces\IRoleRepository;
use App\Interfaces\IRoleService;
use App\Models\Role;
use App\Models\RolePermission;
use App\Traits\ApiResponse;

class RoleService implements IRoleService
{
    use ApiResponse;

    private $roleRepository;
    private $permissionRepository;
    private $rolePermissionRepository;

    public function __construct(
        IRoleRepository $roleRepository,
        IPermissionRepository $permissionRepository,
        IRolePermissionRepository $rolePermissionRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
        $this->rolePermissionRepository = $rolePermissionRepository;
    }

    public function getRoles()
    {
        try {
            $roles = $this->roleRepository->getAll();

            return $this->ok(RoleResource::collection($roles));
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }

    public function saveRole($data)
    {
        try {
            $role = new Role();
            $role->name = $data->name;

            if ($this->roleRepository->saveOrUpdate($role)) {

                $permissions = $this->permissionRepository->getAll();

                foreach ($permissions as $permission) {

                    $rolePermission = new RolePermission();
                    $rolePermission->role_id = $role->id;
                    $rolePermission->permission_id = $permission->id;
                    $rolePermission->active = false;
                    $this->rolePermissionRepository->saveOrUpdate($rolePermission);
                }

                return $this->created(new RoleResource($role));
            }

            return $this->badRequest(['Datos no guardados']);
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }

    public function getRole($id)
    {
        try {
            $role = $this->roleRepository->getById($id);

            if (empty($role))
                return $this->notFound(['Datos no encontrados']);

            return $this->ok(new RoleResource($role));
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }

    public function updateRole($data, $id)
    {
        try {
            $role = $this->roleRepository->getById($id);

            if (empty($role))
                return $this->notFound(['Datos no encontrados']);

            $role->name = $data->name;

            if ($this->roleRepository->saveOrUpdate($role))
                return $this->ok(new RoleResource($role));

            return $this->badRequest(['Datos no actualizados']);
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }

    public function deleteRole($id)
    {
        try {
            $role = $this->roleRepository->getById($id);

            if (empty($role))
                return $this->notFound(['Datos no encontrados']);

            if ($this->roleRepository->delete($role))
                return $this->ok();

            return $this->badRequest(['Datos no eliminados']);
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }

    public function searchRole($critery, $value)
    {
        try {
            $roles = $this->roleRepository->search($critery, $value);

            return $this->ok(RoleResource::collection($roles));
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }
}
