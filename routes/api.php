<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class,'logout']);
    // Almacenar ordenes
    Route::apiResource('/pedidos', PedidoController::class);
});


// API routes
Route::apiResource('/categorias', CategoriaController::class);
Route::apiResource('/productos', ProductoController::class);

// Auth routes
Route::post('/registro', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);