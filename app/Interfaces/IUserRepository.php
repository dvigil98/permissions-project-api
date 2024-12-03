<?php

namespace App\Interfaces;

use App\Models\User;

interface IUserRepository
{
    public function getAll();
    public function saveOrUpdate(User $user);
    public function getById($id);
    public function delete(User $user);
    public function search($critery, $value);
}
