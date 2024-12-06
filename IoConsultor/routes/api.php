<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use \App\Http\Controllers\Api\AccessController;

Route::post('access', [AccessController::class, 'access'])->name('access');
Route::apiResource('patients', PacienteController::class)->middleware('auth:sanctum');
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
