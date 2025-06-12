<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Client\Resources\ReservationController;
use App\Http\Controllers\Client\Resources\BarberController;
use App\Http\Controllers\Client\Resources\ServiceController;

### Resources - Cliente
Route::middleware(['auth', 'verified'])->prefix('client')->name('client.')->group(function () {
    # Only View - Barberos
    Route::resource('barbers', BarberController::class)->only(['index','show']);
    # Only View - Servicios 
    Route::resource('services', ServiceController::class)->only(['index','show']);
    # CRUD Reservas - Cliente
    Route::resource('reservations', ReservationController::class)->except(['destroy']);
});

