<?php

namespace App\Interfaces;

use App\Models\Role;

interface IRoleRepository
{
    public function getAll();
    public function saveOrUpdate(Role $role);
    public function getById($id);
    public function delete(Role $role);
    public function search($critery, $value);
}
