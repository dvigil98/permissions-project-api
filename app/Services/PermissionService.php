<?php

namespace App\Services;

use App\Interfaces\IPermissionRepository;
use App\Interfaces\IPermissionService;
use App\Traits\ApiResponse;

class PermissionService implements IPermissionService
{
    use ApiResponse;

    private $permissionRepository;

    public function __construct(IPermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
}
