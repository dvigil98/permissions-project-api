<?php

namespace App\Repositories;

use App\Interfaces\IPermissionRepository;
use App\Models\Permission;

class PermissionRepository implements IPermissionRepository
{
    public function getAll()
    {
        $permissions = Permission::orderBy('id', 'asc')->get();
        return $permissions;
    }
}
