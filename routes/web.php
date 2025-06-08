<?php

use App\Http\Controllers\Client\ProfileController;
use Illuminate\Support\Facades\Route;

#CRUD ADMIN -- Controladores
use App\Http\Controllers\Admin\Resources\BarberController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('client.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    # CRUD Barberos - Admin
    Route::resource('barbers', BarberController::class);
});

require __DIR__.'/Client/auth.php';
require __DIR__.'/Admin/auth.php';
require __DIR__.'/Barber/auth.php';