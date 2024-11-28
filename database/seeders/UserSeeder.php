<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'role_id' => 1,
                'name' => 'David Vigil',
                'email' => 'dvigil@email.com',
                'password' => 'Admin$1234',
                'active' => true
            ],
            [
                'role_id' => 2,
                'name' => 'Enrique Vigil',
                'email' => 'evigil@email.com',
                'password' => 'Admin$1234',
                'active' => false
            ]
        ];

        foreach ($users as $u) {
            $user = new User();
            $user->role_id = $u['role_id'];
            $user->name = $u['name'];
            $user->email = $u['email'];
            $user->password = Hash::make($u['password']);
            $user->active = $u['active'];
            $user->save();
        }
    }
}
