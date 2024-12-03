<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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

Route::middleware('jwt.verify')->group(function () {

    // logout
    Route::get('/logout', [AuthController::class, 'logout']);

    // roles
    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::get('/roles/{id}', [RoleController::class, 'show']);
    Route::put('/roles/{id}', [RoleController::class, 'update']);
    Route::delete('/roles/{id}', [RoleController::class, 'destroy']);
    Route::get('/roles/{id}/permissions', [RoleController::class, 'getRolePermissions']);
    Route::put('/roles/{id}/permissions', [RoleController::class, 'setRolePermissions']);
    Route::get('/roles/{critery}/{value}/search', [RoleController::class, 'search']);

    // users
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/users/{critery}/{value}/search', [UserController::class, 'search']);
});
