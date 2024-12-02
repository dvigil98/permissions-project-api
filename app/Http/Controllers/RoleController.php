<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleFormRequest;
use App\Http\Requests\UpdateRoleFormRequest;
use App\Http\Requests\UpdateRolePermissionFormRequest;
use App\Interfaces\IRolePermissionService;
use App\Interfaces\IRoleService;

class RoleController extends Controller
{
    private $roleService;
    private $rolePermissionService;

    public function __construct(
        IRoleService $roleService,
        IRolePermissionService $rolePermissionService
    ) {
        $this->roleService = $roleService;
        $this->rolePermissionService = $rolePermissionService;
    }

    public function index()
    {
        return $this->roleService->getRoles();
    }

    public function store(StoreRoleFormRequest $request)
    {
        return $this->roleService->saveRole($request);
    }

    public function show(string $id)
    {
        return $this->roleService->getRole($id);
    }

    public function update(UpdateRoleFormRequest $request, string $id)
    {
        return $this->roleService->updateRole($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->roleService->deleteRole($id);
    }

    public function search(string $critery, string $value)
    {
        return $this->roleService->searchRole($critery, $value);
    }

    public function getRolePermissions(string $id)
    {
        return $this->rolePermissionService->getRolePermissionsByRole($id);
    }

    public function setRolePermissions(UpdateRolePermissionFormRequest $request, string $id)
    {
        return $this->rolePermissionService->setRolePermissionToRole($request, $id);
    }
}
