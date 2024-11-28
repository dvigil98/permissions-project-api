<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Administrador'
            ],
            [
                'name' => 'Usuario'
            ]
        ];

        foreach ($roles as $r) {
            $role = new Role();
            $role->name = $r['name'];
            $role->save();
        }
    }
}
