<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CredencialeController;
use App\Http\Controllers\OficinasEmisoraController;


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::redirect('/', '/home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('credenciales', CredencialeController::class);
    Route::get('credenciales/{id}/pdf', [CredencialeController::class, 'pdf'])->name('credenciales.pdf');
    Route::resource('oficinas-emisoras', OficinasEmisoraController::class);
});
