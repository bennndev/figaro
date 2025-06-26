<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Client\Resources\ReservationController;
use App\Http\Controllers\Client\Resources\BarberController;
use App\Http\Controllers\Client\Resources\ServiceController;

### Resources - Cliente
Route::middleware(['auth', 'verified'])->prefix('client')->name('client.')->group(function () {
    # Endpoint personalizado: mostrar horarios disponibles del barbero (AJAX)
    Route::get('barbers/{barber}/schedules', [BarberController::class, 'availableSchedules'])
        ->name('barbers.schedules');

    # Endpoint personalizado: mostrar bloques disponibles según horario + servicio
    Route::post('reservations/available-slots', [ReservationController::class, 'availableSlots'])
    ->name('reservations.available-slots');

    # CRUD completo de reservas (EXCEPTO destroy)
    Route::resource('reservations', ReservationController::class)->except(['destroy']);

    # Solo vistas de barberos y servicios
    Route::resource('barbers', BarberController::class)->only(['index', 'show']);
    Route::resource('services', ServiceController::class)->only(['index', 'show']);
});
