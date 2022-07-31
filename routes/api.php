<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MessageController;
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

Route::group(["middleware" => ["jwt.auth", "isSuperAdmin"]], function() {
    Route::post('/user/super_admin/{id}', [UserController::class, 'addSuperAdminRole']);
    Route::post('/user/super_admin_delete/{id}', [UserController::class, 'deleteSuperAdminRole']);
    Route::post('/user/add_admin/{id}', [UserController::class, 'addAdminRole']);
    Route::post('/user/delete_admin/{id}', [UserController::class, 'deleteAdminRole']);
});

//GameController Endpoints
Route::group(["middleware" => "jwt.auth"], function() {
    Route::get('/games/get_games', [GameController::class, 'getGames']);  
});
Route::group(["middleware" => ["jwt.auth", "isSuperAdmin"]], function() {
    Route::post('/games/add_game', [GameController::class, 'addGame']);
    Route::put('/games/update_game/{id}', [GameController::class, 'updateGame']);
    Route::delete('/games/delete_game/{id}', [GameController::class, 'deleteGame']);
});

//Channel Endpoints
Route::group(["middleware" => "jwt.auth"], function() {
    Route::post('/channels/create', [ChannelController::class, 'createChannel']);  
    Route::post('/channels/join_to_channel/{id}', [ChannelController::class, 'joinToChannel']);  
    
});
Route::group(["middleware" => ["jwt.auth", "isAdmin"]], function() {
    Route::delete('/channels/delete_channel/{id}', [ChannelController::class, 'deleteChannel']);
    
});
Route::group(["middleware" => ["jwt.auth", "isSuperAdmin"]], function() {
    Route::delete('/channels/delete_channel/{id}', [ChannelController::class, 'deleteChannel']);
    
});

//Messages endpoints
Route::group(["middleware" => "jwt.auth"], function() {
    Route::post('/messages/create', [MessageController::class, 'createMessage']);  
    Route::get('/messages/get', [MessageController::class, 'getMessages']);  
    Route::put('/messages/edit/{id}', [MessageController::class, 'editMessage']);  
    Route::delete('/messages/delete/{id}', [MessageController::class, 'deleteMessage']);  
    
});