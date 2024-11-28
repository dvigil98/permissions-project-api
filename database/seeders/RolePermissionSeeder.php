<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all();
        $permissions = Permission::all();

        foreach ($roles as $role) {
            foreach ($permissions as $permission) {
                $rolePermission = new RolePermission();
                $rolePermission->role_id = $role->id;
                $rolePermission->permission_id = $permission->id;
                if ($role->name == 'Administrador')
                    $rolePermission->active = true;
                else
                    $rolePermission->active = false;
                $rolePermission->save();
            }
        }
    }
}
