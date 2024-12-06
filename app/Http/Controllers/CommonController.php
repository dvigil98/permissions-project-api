<?php

namespace App\Http\Controllers;

use App\Interfaces\IRoleService;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    private $roleService;

    public function __construct(IRoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function getRoles()
    {
        return $this->roleService->getRoles();
    }
}
