<?php

use App\Http\Controllers\Barber\Resources\PaymentController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Barber\Resources\ScheduleController;
use App\Http\Controllers\Barber\Resources\ReservationController;
use App\Http\Controllers\Barber\DashboardController;

Route::middleware(['auth:barber', 'barber.verified'])->prefix('barber')->name('barber.')->group(function () {
    # CRUD Horarios - Barbero
    Route::resource('schedules', ScheduleController::class);
    
    # Calendario de Horarios
    Route::get('schedules-calendar', [ScheduleController::class, 'calendar'])->name('schedules.calendar');
    
    # CRUD Reservas - Barbero (solo index y show)
    Route::resource('reservations', ReservationController::class)->only(['index', 'show']);
    
    # Marcar reserva como completada
    Route::patch('reservations/{id}/complete', [ReservationController::class, 'markAsCompleted'])
        ->name('reservations.complete');

    Route::resource('payments', PaymentController::class)->only(['index', 'show']);

    # Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
