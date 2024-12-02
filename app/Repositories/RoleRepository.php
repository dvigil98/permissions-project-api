<?php

namespace App\Repositories;

use App\Interfaces\IRoleRepository;
use App\Models\Role;

class RoleRepository implements IRoleRepository
{
    public function getAll()
    {
        $roles = Role::orderBy('id', 'asc')->get();
        return $roles;
    }

    public function saveOrUpdate(Role $role)
    {
        return $role->save();
    }

    public function getById($id)
    {
        $role = Role::find($id);
        return $role;
    }

    public function delete(Role $role)
    {
        return $role->delete();
    }

    public function search($critery, $value)
    {
        $roles = Role::orderBy('id', 'asc')->where($critery, 'like', "%{$value}%")->get();
        return $roles;
    }
}
