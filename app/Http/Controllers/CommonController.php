<?php

namespace App\Http\Controllers;

use App\Interfaces\ICommonService;
use App\Interfaces\IRoleService;

class CommonController extends Controller
{
    private $roleService;
    private $commonService;

    public function __construct(
        IRoleService $roleService,
        ICommonService $commonService
    ) {
        $this->roleService = $roleService;
        $this->commonService = $commonService;
    }

    public function getRoles()
    {
        return $this->roleService->getRoles();
    }

    public function getModules()
    {
        return $this->commonService->getModules();
    }
}
