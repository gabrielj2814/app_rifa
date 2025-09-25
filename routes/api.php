<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/helpcheck', function () {
    return response()->json(['status' => 'ok']);
});

// Route::prefix('app')->group(function () {
//     Route::prefix('v1')->group(function () {
//         Route::middleware('auth:sanctum')->group(function () {

//         });
//     });
// });


Route::prefix('auth')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
});

Route::prefix("account")->group(function () {
    Route::prefix("customer")->group(function () {
        Route::post("/create",[ClienteController::class,"registrar"]);
    });

    // Route::prefix("employee")->group(function () {

    // });


});
