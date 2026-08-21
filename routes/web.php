<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ArticulosPedidoController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\LugareController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HomeControllerCoco;
use App\Http\Controllers\PedidoCocoController;
use App\Http\Controllers\ArticulosPedidoCocoController;
use App\Http\Controllers\TipoCocoController;
use App\Http\Controllers\LugareCocoController;
use App\Http\Controllers\ColorCocoController;


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::redirect('/', '/home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/inicio', [HomeController::class, 'inicio'])->name('inicio');
    Route::get('pedidos-por-fecha', [PedidoController::class, 'porFecha'])->name('pedidos.por-fecha');
    Route::get('articulos-por-color', [PedidoController::class, 'articulosPorColor'])->name('pedidos.articulos-por-color');
    Route::post('articulos-pedidos/{articulo}/realizado', [ArticulosPedidoController::class, 'actualizarRealizado'])
        ->name('articulos-pedidos.actualizar-realizado');
    Route::resource('pedidos', PedidoController::class);
    Route::resource('articulos-pedidos', ArticulosPedidoController::class);
    Route::resource('tipos', TipoController::class);
    Route::resource('lugares', LugareController::class);
    Route::resource('colores', ColorController::class);
    Route::resource('user', UserController::class);
    Route::resource('roles', RoleController::class);

    // CocoSublime
    Route::get('/coco-home', [HomeControllerCoco::class, 'index'])->name('coco-home');
    Route::get('/coco-inicio', [HomeControllerCoco::class, 'inicio'])->name('coco-inicio');
    Route::get('coco-pedidos-por-fecha', [PedidoCocoController::class, 'porFecha'])->name('coco-pedidos.por-fecha');
    Route::get('coco-articulos-por-color', [PedidoCocoController::class, 'articulosPorColor'])->name('coco-pedidos.articulos-por-color');
    Route::post('coco-articulos-pedidos/{articulo}/realizado', [ArticulosPedidoCocoController::class, 'actualizarRealizado'])
        ->name('coco-articulos-pedidos.actualizar-realizado');
    Route::resource('coco-pedidos', PedidoCocoController::class);
    Route::resource('coco-articulos-pedidos', ArticulosPedidoCocoController::class);
    Route::resource('coco-tipos', TipoCocoController::class);
    Route::resource('coco-lugares', LugareCocoController::class);
    Route::resource('coco-colores', ColorCocoController::class);
});
