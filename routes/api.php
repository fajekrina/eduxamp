<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/role/all', [RoleController::class, 'getAll'])->name('api.role.all');
// Route::post('/role/store', [RoleController::class, 'store'])->name('api.role.store');
// Route::post('/role/update/{id}', [RoleController::class, 'update'])->name('api.role.update');
// Route::get('/role/find/{id}', [RoleController::class, 'find'])->name('api.role.find');
// Route::get('/role/destroy/{id}', [RoleController::class, 'destroy'])->name('api.role.destroy');

// Route::get('/user/all', [UserController::class, 'getAll'])->name('api.user.all');
// Route::post('/user/store', [UserController::class, 'store'])->name('api.user.store');
// Route::post('/user/update/{id}', [UserController::class, 'update'])->name('api.user.update');
// Route::get('/user/find/{id}', [UserController::class, 'find'])->name('api.user.find');
// Route::get('/user/destroy/{id}', [UserController::class, 'destroy'])->name('api.user.destroy');