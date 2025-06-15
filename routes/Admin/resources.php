<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Resources\BarberController;
use App\Http\Controllers\Admin\Resources\SpecialtyController;
use App\Http\Controllers\Admin\Resources\ClientController;
use App\Http\Controllers\Admin\Resources\ServiceController;

Route::middleware(['auth:admin', 'admin.verified'])->prefix('admin')->name('admin.')->group(function () {
    # CRUD Barberos - Admin
    Route::resource('barbers', BarberController::class);
    # CRUD Especialidades - Admin
    Route::resource('specialties', SpecialtyController::class);
    # CRUD Clientes - Admin (Solo ver los registros)
    Route::resource('clients', ClientController::class)->only(['index', 'show']);
    # CRUD Servicios - Admin
    Route::resource('services', ServiceController::class);
});
