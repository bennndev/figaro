<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Barber\Resources\ScheduleController;
use App\Http\Controllers\Barber\Resources\ReservationController;

Route::middleware(['auth:barber', 'barber.verified'])->prefix('barber')->name('barber.')->group(function () {
    # CRUD Horarios - Barbero
    Route::resource('schedules', ScheduleController::class);
    
    # CRUD Reservas - Barbero (solo index y show)
    Route::resource('reservations', ReservationController::class)->only(['index', 'show']);
});
