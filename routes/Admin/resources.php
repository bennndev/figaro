<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Resources\DashboardController;
use App\Http\Controllers\Admin\Resources\BarberController;
use App\Http\Controllers\Admin\Resources\SpecialtyController;
use App\Http\Controllers\Admin\Resources\ClientController;
use App\Http\Controllers\Admin\Resources\ServiceController;
use App\Http\Controllers\Admin\Resources\ScheduleController;
use App\Http\Controllers\Admin\Resources\ReservationController;
use App\Http\Controllers\Admin\Resources\PaymentController;

Route::middleware(['auth:admin', 'admin.verified'])->prefix('admin')->name('admin.')->group(function () {
    # CRUD Barberos - Admin
    Route::resource('barbers', BarberController::class);
    # CRUD Especialidades - Admin
    Route::resource('specialties', SpecialtyController::class);
    # CRUD Clientes - Admin (Solo ver los registros)
    Route::resource('clients', ClientController::class);
    # CRUD Servicios - Admin
    Route::resource('services', ServiceController::class);
    # CRUD Horarios - Admin
    Route::resource('schedules', ScheduleController::class);
    # Only View - Reservas
    Route::resource('reservations', ReservationController::class)->only(['index', 'show']);
    # Only View - Pagos
    Route::resource('payments', PaymentController::class)->only(['index', 'show']);
});
