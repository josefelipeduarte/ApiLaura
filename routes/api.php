<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/entrar', [AuthController::class, 'login']);
    Route::get('/user', function () {
        return request()->user();
    })->middleware('auth:sanctum');

    Route::post('registrar', [AuthController::class, 'create']);

    Route::post('/sair', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});
