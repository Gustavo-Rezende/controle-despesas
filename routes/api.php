<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartaoController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\UsusarioController;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('/usuarios', UsusarioController::class);
    Route::apiResource('/despesas', DespesaController::class);
    Route::apiResource('/cartoes', CartaoController::class);

});
