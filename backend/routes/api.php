<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post("login", [AuthController::class,'login']);
Route::post("register", [AuthController::class,'register']);

// All Secure URL's
Route::middleware('auth:sanctum')->get('/athenticated', function () {
    return true;
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('todos', App\Http\Controllers\TodoController::class);
    Route::apiResource('tasks', App\Http\Controllers\TaskController::class);
});
