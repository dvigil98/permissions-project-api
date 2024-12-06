<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Role;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// login
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwtAuth')->group(function () {

    // logout
    Route::get('/logout', [AuthController::class, 'logout']);

    // roles
    Route::controller(RoleController::class)->prefix('/roles')->group(function () {

        Route::get('/', 'index')->middleware('permission:ver_roles');
        Route::post('/', 'store')->middleware('permission:agregar_roles');
        Route::get('/{id}', 'show')->middleware('permission:ver_roles');
        Route::put('/{id}', 'update')->middleware('permission:editar_roles');
        Route::delete('/{id}', 'destroy')->middleware('permission:eliminar_roles');
        Route::get('/{id}/permissions', 'getRolePermissions')->middleware('permission:asignar_permisos_roles');
        Route::put('/{id}/permissions', 'setRolePermissions')->middleware('permission:asignar_permisos_roles');
        Route::get('/{critery}/{value}/search', 'search')->middleware('permission:ver_roles');
    });

    // users
    Route::controller(UserController::class)->prefix('/users')->group(function () {

        Route::get('/', 'index')->middleware('permission:ver_usuarios');
        Route::post('/', 'store')->middleware('permission:agregar_usuarios');
        Route::get('/{id}', 'show')->middleware('permission:ver_usuarios');
        Route::put('/{id}', 'update')->middleware('permission:editar_usuarios');
        Route::delete('/{id}', 'destroy')->middleware('permission:eliminar_usuarios');
        Route::get('/{critery}/{value}/search', 'search')->middleware('permission:ver_usuarios');
    });

    // rutas sin permisos requeridos
    Route::controller(CommonController::class)->group(function () {

        Route::get('/common/roles', 'getRoles');
    });
});
