<?php

namespace App\Repositories;

use App\Interfaces\IRolePermissionRepository;
use App\Models\RolePermission;

class RolePermissionRepository implements IRolePermissionRepository
{
    public function saveOrUpdate(RolePermission $rolePermission)
    {
        return $rolePermission->save();
    }

    public function getById($id)
    {
        $rolePermission = RolePermission::find($id);
        return $rolePermission;
    }

    public function getRolePermissionsByRole($role_id)
    {
        $rolePermissions = RolePermission::orderBy('id', 'asc')->where('role_id', $role_id)->get();
        return $rolePermissions;
    }
}
