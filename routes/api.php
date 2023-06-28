<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\Serial_onuController;
use App\Http\Controllers\Serial_OnuPanelController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

//Rota para teste da API.
Route::get('/', function () {
    return response()->json(['status' => 'OK'], 200);
});

Route::prefix('auth')->group(function () {
    Route::post('/entrar', [AuthController::class, 'login']);

    //é necessário ser admin e estar logado para conseguir registrar alguém.
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/registrar', [AuthController::class, 'create'])->middleware('admin');
        Route::post('/sair', [AuthController::class, 'logout']);

        //Lista somente 1 usuário.
        Route::get('/usuario', function () {
            return request()->user();
        });

        Route::get('/listar', [AuthController::class, 'selectAllUsers']);
        Route::delete('/deletar/{id_user}', [AuthController::class, 'destroy'])->middleware('admin');
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('serial')->group(function () {
        Route::get('/', [Serial_onuController::class, 'index']);
        Route::get('/pesquisar/{serial}', [Serial_onuController::class, 'pesquisarSerial']);
        Route::get('/{id_de}', [Serial_onuController::class, 'show']);
        Route::put('/{update_id}', [Serial_onuController::class, 'update'])->middleware('admin');
        Route::post('/', [Serial_onuController::class, 'store'])->middleware('admin');
        Route::delete('/{serial_delete}', [Serial_onuController::class, 'destroy'])->middleware('admin');
    });
});
Route::prefix('serial_painel')->group(function () {
    Route::get('quantPorTipo/{ano?}', [Serial_OnuPanelController::class, 'quantPorTipo']);
    Route::get('quantMes/{ano}', [Serial_OnuPanelController::class, 'quantMes']);
});
