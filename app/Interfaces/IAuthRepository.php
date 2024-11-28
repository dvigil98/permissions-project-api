<?php

namespace App\Interfaces;

interface IAuthRepository
{
    public function getUserByEmail($email);
}
