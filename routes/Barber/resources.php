<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Barber\Resources\ScheduleController;

Route::middleware(['auth:barber', 'barber.verified'])->prefix('barber')->name('barber.')->group(function () {
    # CRUD Horarios - Barbero
    Route::resource('schedules', ScheduleController::class);
});
