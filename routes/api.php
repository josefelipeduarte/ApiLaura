<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\Serial_onuController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/entrar', [AuthController::class, 'login']);
    Route::get('/user', function () {
        return request()->user();
    })->middleware('auth:sanctum');

    Route::post('registrar', [AuthController::class, 'create'])->middleware('admin');

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
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('serial')->group(function () {
        Route::get('/', [Serial_onuController::class, 'index']);
        Route::get('/pesquisar/{serial}', [Serial_onuController::class, 'pesquisarSerial']);
        Route::get('/{id_de}', [Serial_onuController::class, 'show']);
        Route::put('/{id_de}', [Serial_onuController::class, 'update'])->middleware('admin');
        Route::post('/', [Serial_onuController::class, 'store'])->middleware('admin');
        Route::delete('/{id_de}', [Serial_onuController::class, 'destroy'])->middleware('admin');
    });
});
