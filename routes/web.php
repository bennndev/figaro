<?php

use App\Http\Controllers\Client\Resources\ReservationController;
use Illuminate\Support\Facades\Route;

// Rutas públicas
Route::get('/', function () {
    return view('home');
});

Route::get('/reservar', function () {
    return view('citas.reservar');
});

Route::post('/citas/guardar', [ReservationController::class, 'store']);

// Rutas de Autenticación
require __DIR__.'/Client/auth.php';
require __DIR__.'/Admin/auth.php';
require __DIR__.'/Barber/auth.php';

// Rutas de CRUD
require __DIR__.'/Client/resources.php';
require __DIR__.'/Admin/resources.php';
require __DIR__.'/Barber/resources.php';
