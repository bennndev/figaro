<?php

use Illuminate\Support\Facades\Route;

#CRUD ADMIN -- Controladores
use App\Http\Controllers\Admin\Resources\BarberController;
use App\Http\Controllers\Admin\Resources\SpecialtyController;
use App\Http\Controllers\Admin\Resources\ClientController;
use App\Http\Controllers\Admin\Resources\ServiceController;

#CRUD CLIENTE -- Controladores
use App\Http\Controllers\Client\Resources\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

### Resources - Barbero -> Después se creará un .php con estas rutas y se importara con require para modular mucho más el código.

Route::middleware('auth:admin, admin.verified')->prefix('admin')->name('admin.')->group(function () {
    # CRUD Barberos - Admin
    Route::resource('barbers', BarberController::class);
    # CRUD Especialidades - Admin
    Route::resource('specialties', SpecialtyController::class);
    # CRUD Clientes - Admin (Solo ver los registros)
    Route::resource('clients', ClientController::class)->only(['index', 'show']);
    # CRUD Servicios - Admin
    Route::resource('services', ServiceController::class);
});

### Resources - Cliente
Route::middleware(['auth', 'verified'])->prefix('client')->name('client.')->group(function () {
    # CRUD Reservas - Cliente
    Route::resource('reservations', ReservationController::class)->except('destroy');
});

require __DIR__.'/Client/auth.php';
require __DIR__.'/Admin/auth.php';
require __DIR__.'/Barber/auth.php';