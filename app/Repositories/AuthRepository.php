<?php

namespace App\Repositories;

use App\Interfaces\IAuthRepository;
use App\Models\User;

class AuthRepository implements IAuthRepository
{
    public function getUserByEmail($email)
    {
        $user = User::where('email', $email)->first();
        return $user;
    }
}
