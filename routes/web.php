<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ArticulosPedidoController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\LugareController;
use App\Http\Controllers\ColorController;


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::redirect('/', '/home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('pedidos-por-fecha', [PedidoController::class, 'porFecha'])->name('pedidos.por-fecha');
    Route::get('articulos-por-color', [PedidoController::class, 'articulosPorColor'])->name('pedidos.articulos-por-color');
    Route::post('articulos-pedidos/{articulo}/realizado', [ArticulosPedidoController::class, 'actualizarRealizado'])
        ->name('articulos-pedidos.actualizar-realizado');
    Route::resource('pedidos', PedidoController::class);
    Route::resource('articulos-pedidos', ArticulosPedidoController::class);
    Route::resource('tipos', TipoController::class);
    Route::resource('lugares', LugareController::class);
    Route::resource('colores', ColorController::class);
});
