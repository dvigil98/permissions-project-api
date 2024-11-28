<?php

namespace App\Interfaces;

interface IAuthService
{
    public function login($email, $password);
    public function logout();
}
