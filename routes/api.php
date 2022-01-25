<?php

use App\Models\Estoque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Pedido;
use App\Http\Controllers\EstoqueServer;
use App\Http\Controllers\ReservaServer;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return Pedido::with('itens')->get();
});

Route::post('/finalizar', [EstoqueServer::class, 'finalizar']);

Route::post('/reservar', [ReservaServer::class, 'store']);


