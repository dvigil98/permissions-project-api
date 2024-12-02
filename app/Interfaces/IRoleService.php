<?php

namespace App\Interfaces;

interface IRoleService
{
    public function getRoles();
    public function saveRole($data);
    public function getRole($id);
    public function updateRole($data, $id);
    public function deleteRole($id);
    public function searchRole($critery, $value);
}
