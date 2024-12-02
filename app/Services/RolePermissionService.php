<?php

namespace App\Services;

use App\Http\Resources\RolePermissionResource;
use App\Interfaces\IRolePermissionRepository;
use App\Interfaces\IRolePermissionService;
use App\Interfaces\IRoleRepository;
use App\Traits\ApiResponse;

class RolePermissionService implements IRolePermissionService
{
    use ApiResponse;

    private $rolePermissionRepository;
    private $roleRepository;

    public function __construct(
        IRolePermissionRepository $rolePermissionRepository,
        IRoleRepository $roleRepository
    ) {
        $this->rolePermissionRepository = $rolePermissionRepository;
        $this->roleRepository = $roleRepository;
    }

    public function getRolePermissionsByRole($role_id)
    {
        try {
            $role = $this->roleRepository->getById($role_id);

            if (empty($role))
                return $this->notFound(['Datos no encontrados']);

            $rolePermissions = $this->rolePermissionRepository->getRolePermissionsByRole($role_id);

            return $this->ok(RolePermissionResource::collection($rolePermissions));
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }

    public function setRolePermissionToRole($data, $role_id)
    {
        try {
            $role = $this->roleRepository->getById($role_id);

            if (empty($role))
                return $this->notFound(['Datos no encontrados']);

            foreach ($data->role_permissions as $role_permission) {
                $rolePermission = $this->rolePermissionRepository->getById($role_permission['id']);
                $rolePermission->active = $role_permission['active'];
                $this->rolePermissionRepository->saveOrUpdate($rolePermission);
            }

            $rolePermissions = $this->rolePermissionRepository->getRolePermissionsByRole($role_id);

            return $this->ok(RolePermissionResource::collection($rolePermissions));
        } catch (\Throwable $th) {
            return $this->internalServerError([$th->getMessage()]);
        }
    }
}
