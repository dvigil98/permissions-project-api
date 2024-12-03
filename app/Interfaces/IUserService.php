<?php

namespace App\Interfaces;

interface IUserService
{
    public function getUsers();
    public function saveUser($data);
    public function getUser($id);
    public function updateUser($data, $id);
    public function deleteUser($id);
    public function searchUser($critery, $value);
}
