<?php

namespace App\Interfaces;

interface IRolePermissionService
{
    public function getRolePermissionsByRole($role_id);
    public function setRolePermissionToRole($data, $role_id);
}
