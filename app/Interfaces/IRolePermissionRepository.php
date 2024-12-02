<?php

namespace App\Interfaces;

use App\Models\RolePermission;

interface IRolePermissionRepository
{
    public function saveOrUpdate(RolePermission $rolePermission);
    public function getById($id);
    public function getRolePermissionsByRole($role_id);
}
