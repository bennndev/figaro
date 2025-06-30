<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Client\Resources\ReservationController;
use App\Http\Controllers\Client\Resources\BarberController;
use App\Http\Controllers\Client\Resources\ServiceController;
use App\Http\Controllers\Client\Resources\PaymentController;
use App\Http\Controllers\Client\Resources\AssistantController;

# Resources - Cliente
Route::middleware(['auth', 'verified'])->prefix('client')->name('client.')->group(function () {

    // Barberos (solo vistas)
    Route::resource('barbers', BarberController::class)->only(['index', 'show']);
    Route::get('barbers/{barber}/schedules', [BarberController::class, 'availableSchedules'])
        ->name('barbers.schedules');

    // Servicios (solo vistas)
    Route::resource('services', ServiceController::class)->only(['index', 'show']);
    Route::get('services/specialty/{id}', [ServiceController::class, 'getBySpecialty'])
        ->name('services.getBySpecialty');

    // Reservas (CRUD excepto destroy)
    Route::resource('reservations', ReservationController::class)->except(['destroy']);
    Route::post('reservations/available-slots', [ReservationController::class, 'availableSlots'])
        ->name('reservations.available-slots');

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
    Route::resource('assistant', \App\Http\Controllers\Client\Resources\AssistantController::class)
        ->only(['index']);
    Route::post('assistant/ask', [\App\Http\Controllers\Client\Resources\AssistantController::class, 'ask'])
        ->name('assistant.ask');
});

