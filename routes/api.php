<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::apiResource('posts', PostController::class);
Route::get('/posts', [PostController::class, 'index']);

Route::post("/auth/login",[AuthController::class,"login"]);

Route::get('/users', [UserController::class, 'getUsers']);
Route::post('/users', [UserController::class, 'createUsers']);
Route::put('/users/{userID}', [UserController::class, 'updateUsers']);
Route::delete('/users/{userID}', [UserController::class, 'deleteUsers']);