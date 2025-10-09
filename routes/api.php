<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RifaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/helpcheck', function () {
    return response()->json(['status' => 'ok']);
});

Route::prefix('app/v1')->group(function () {

    Route::prefix('personal')->middleware('auth:sanctum')->group(function () {
        Route::get('/',                                      [AdminController::class, 'getAll']);
        Route::get('/{id}',                                  [AdminController::class, 'consultById']);
        Route::delete('/{id}',                               [AdminController::class, 'delete']);
        Route::post('/',                                     [AdminController::class, 'create']);
        Route::post('/filtrar-paginate',                     [AdminController::class, 'filtrarPaginate']);
        Route::post('/filtrar',                              [AdminController::class, 'filtrarWithoutPaginate']);
        Route::put('/actualizar-roles',                      [AdminController::class, 'actualizarRoles']);
    });

    Route::prefix("rifa")->group(function () {
        Route::get("/",                         [RifaController::class,"getAll"]);
        Route::post("/",                        [RifaController::class,"createRifa"]);
        Route::get("/{id}",                     [RifaController::class,"getById"]);
        Route::put("/{id}",                     [RifaController::class,"editRifa"]);
        Route::post("/filtrar-paginate",        [RifaController::class,"paginate"]);
        Route::post("/filtrar",                 [RifaController::class,"filtrar"]);
        Route::get("/{id}/finalizar",           [RifaController::class,"finalizarRifa"]);
    });

});


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
