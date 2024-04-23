<?php

use App\Http\Controllers\ReservaController;
use App\Http\Controllers\SalaZoomController;
use App\Http\Controllers\UserController;
use App\Models\SalaZoom;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('reservas', ReservaController::class)->middleware('auth');
Route::resource('salazoom', SalaZoomController::class)->middleware('auth');
Route::resource('usuarios', UserController::class)->middleware('auth');

Route::patch('/usuarios/{usuario}/update-password', [UserController::class, 'updatePassword'])->name('usuarios.update_password');

