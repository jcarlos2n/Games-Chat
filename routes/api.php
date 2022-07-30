<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//AuthController Endpoints

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/profile', [AuthController::class, 'profile'])->middleware('jwt.auth');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('jwt.auth');

//Add Roles whit UserController Endpoints

Route::group(["middleware" => "jwt.auth", "isSuperAdmin"], function() {
    Route::post('/user/super_admin/{id}', [UserController::class, 'addSuperAdminRole']);
    Route::post('/user/super_admin_delete/{id}', [UserController::class, 'deleteSuperAdminRole']);
    Route::post('/user/add_admin/{id}', [UserController::class, 'addAdminRole']);
    Route::post('/user/delete_admin/{id}', [UserController::class, 'deleteAdminRole']);
});

//GameController Endpoints
Route::group(["middleware" => "jwt.auth"], function() {
    Route::get('/games/get_games', [GameController::class, 'getGames']);  
});
Route::group(["middleware" => "jwt.auth", "isSuperAdmin"], function() {
    Route::post('/games/add_game', [GameController::class, 'addGame']);
    Route::put('/games/update_game/{id}', [GameController::class, 'updateGame']);
    // Route::post('/user/add_admin/{id}', [UserController::class, 'addAdminRole']);
    // Route::post('/user/delete_admin/{id}', [UserController::class, 'deleteAdminRole']);
});
