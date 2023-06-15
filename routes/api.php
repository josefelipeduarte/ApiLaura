<?php

use App\Http\Controllers\AuthController;
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
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('schools')->group(function () {
        Route::get('/', [SchoolController::class, 'index']);
        Route::get('/{school}', [SchoolController::class, 'show']);
        Route::put('/{school}', [SchoolController::class, 'update'])->middleware('admin');
        Route::post('/', [SchoolController::class, 'store'])->middleware('admin');
        Route::delete('/{school}', [SchoolController::class, 'destroy'])->middleware('admin');
    });
});
