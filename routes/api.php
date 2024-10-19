<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware('web')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/sanctum/csrf-cookie', function (Request $request) {
        return response()->json(['message' => 'CSRF cookie set']);
    });
});

Route::middleware(['web', 'auth:sanctum'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);

    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/task/checked/{task}', [TaskController::class, 'checked']);

    Route::post('/add/task', [TaskController::class, 'add']);
});
