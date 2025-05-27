<?php

use App\Http\Middleware\ClienteValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rotas para os recursos da API
Route::get('/clientes', [App\Http\Controllers\Api\ClienteController::class, 'index']);
Route::post('/clientes', [App\Http\Controllers\Api\ClienteController::class, 'store'])->middleware(ClienteValidation::class);
Route::put('/clientes/{id}', [App\Http\Controllers\Api\ClienteController::class, 'update']);
Route::delete('/clientes/{id}', [App\Http\Controllers\Api\ClienteController::class, 'destroy']);

Route::get('/estados', [App\Http\Controllers\Api\CidadeController::class, 'getEstados']);
