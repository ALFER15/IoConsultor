<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PacienteController;
use \App\Http\Controllers\Api\AccessController;
use \App\Http\Controllers\Api\AssignmentCheck;
use App\Http\Controllers\Api\DoctorAssignmentController;
use App\Http\Controllers\Api\SummaryController;



Route::get('system-summary', [SummaryController::class, 'getCounts'])->middleware('auth:sanctum');
Route::get('unassigned-doctors', [DoctorAssignmentController::class, 'unassignedDoctors'])->middleware('auth:sanctum');
Route::post('access', [AccessController::class, 'access'])->name('access');
Route::apiResource('patients', PacienteController::class)->middleware('auth:sanctum');
Route::apiResource('assignmentC', AssignmentCheck::class)->middleware('auth:sanctum');
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
