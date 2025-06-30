<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Client\Resources\ReservationController;
use App\Http\Controllers\Client\Resources\BarberController;
use App\Http\Controllers\Client\Resources\ServiceController;
use App\Http\Controllers\Client\Resources\PaymentController;
### Resources - Cliente
Route::middleware(['auth', 'verified'])->prefix('client')->name('client.')->group(function () {

    # Only View - Barberos
    Route::resource('barbers', BarberController::class)->only(['index','show']);
    # Only View - Servicios 
    Route::resource('services', ServiceController::class)->only(['index','show']);
    # CRUD Reservas - Cliente
    Route::resource('reservations', ReservationController::class)->except(['destroy']);
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
    # Payment
    ## Primero los callbacks “estáticos” para evitar choque con payments/{payment}
    Route::get('payments/success', [PaymentController::class, 'success'])
         ->name('payments.success');
    Route::get('payments/failure', [PaymentController::class, 'failure'])
         ->name('payments.failure');
    Route::get('payments/pending', [PaymentController::class, 'pending'])
         ->name('payments.pending');
    ## Después el resource que incluye index, store y show(id)
    Route::resource('payments', PaymentController::class)
         ->only(['index','store','show']);
     ## Generar reporte PDF del pago
    # Este endpoint descarga el reporte del pago en PDF
    Route::get(
        'payments/{id}/report',
        [PaymentController::class, 'downloadReport']
    )->name('payments.report');
     # Asistente
    Route::resource('assistant', \App\Http\Controllers\Client\Resources\AssistantController::class)
        ->only(['index']);
    Route::post('assistant/ask', [\App\Http\Controllers\Client\Resources\AssistantController::class, 'ask'])
        ->name('assistant.ask');
});

