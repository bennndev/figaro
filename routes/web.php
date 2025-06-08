<?php

use Illuminate\Support\Facades\Route;

#CRUD ADMIN -- Controladores
use App\Http\Controllers\Admin\Resources\BarberController;
use App\Http\Controllers\Admin\Resources\SpecialtyController;
use App\Http\Controllers\Admin\Resources\ClientController;
use App\Http\Controllers\Admin\Resources\ServiceController;


Route::get('/', function () {
    return view('welcome');
});

### Resources - Barbero -> Después se creará un .php con estas rutas y se importara con require para modular mucho más el código.

Route::middleware('auth:admin, admin.verified')->prefix('admin')->name('admin.')->group(function () {
    # CRUD Barberos - Admin
    Route::resource('barbers', BarberController::class);
    Route::resource('specialties', SpecialtyController::class);
    Route::resource('clients', ClientController::class)->only(['index', 'show']);
    Route::resource('services', ServiceController::class);
});

require __DIR__.'/Client/auth.php';
require __DIR__.'/Admin/auth.php';
require __DIR__.'/Barber/auth.php';