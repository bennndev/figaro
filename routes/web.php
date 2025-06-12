<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

# Rutas de Autenticación
require __DIR__.'/Client/auth.php';
require __DIR__.'/Admin/auth.php';
require __DIR__.'/Barber/auth.php';

# Rutas de CRUD
require __DIR__.'/Client/resources.php';
require __DIR__.'/Admin/resources.php';
