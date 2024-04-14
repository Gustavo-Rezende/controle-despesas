<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartaoController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Middleware\VerificarTipoUsuario;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/usuarios', [UsuarioController::class, 'index']);
    Route::get('/cartoes', [CartaoController::class, 'index']);
    Route::get('/despesas', [DespesaController::class, 'index']);

    Route::middleware(VerificarTipoUsuario::class)->group(function () {
        Route::post('/usuarios', [UsuarioController::class, 'store']);
        Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
        Route::put('/usuarios/{id}', [UsuarioController::class, 'update']);
        Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy']);

        Route::post('/cartoes', [CartaoController::class, 'store']);
        Route::get('/cartoes/{id}', [CartaoController::class, 'show']);
        Route::put('/cartoes/{id}', [CartaoController::class, 'update']);
        Route::delete('/cartoes/{id}', [CartaoController::class, 'destroy']);

        Route::post('/despesas', [DespesaController::class, 'store']);
        Route::get('/despesas/{id}', [DespesaController::class, 'show']);
        Route::put('/despesas/{id}', [DespesaController::class, 'update']);
        Route::delete('/despesas/{id}', [DespesaController::class, 'destroy']);
    });
});
