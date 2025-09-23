<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/helpcheck', function () {
    return response()->json(['status' => 'ok']);
});


Route::prefix('auth')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        // Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
        // Route::get('/user', [\App\Http\Controllers\AuthController::class, 'user']);w
    });
});















