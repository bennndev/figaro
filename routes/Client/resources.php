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
    # Payment
    Route::resource('payments', PaymentController::class)
              ->only(['index','store','show']);
    // Para mantener los callbacks de Stripe:
    Route::get('payments/success', [PaymentController::class, 'success'])
              ->name('payments.success');
    Route::get('payments/failure', [PaymentController::class, 'failure'])
              ->name('payments.failure');
    Route::get('payments/pending', [PaymentController::class, 'pending'])
              ->name('payments.pending');
                  // Asistente
    Route::resource('assistant', \App\Http\Controllers\Client\Resources\AssistantController::class)
        ->only(['index']);
    
    Route::post('assistant/ask', [\App\Http\Controllers\Client\Resources\AssistantController::class, 'ask'])
        ->name('assistant.ask');
});

