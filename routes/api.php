<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HabitCompletionController;
use App\Http\Controllers\HabitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('habits', HabitController::class);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::post('/habits/{habit}/complete', [HabitCompletionController::class, 'store']);
    Route::delete('/habits/{habit}/complete', [HabitCompletionController::class, 'destroy']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
