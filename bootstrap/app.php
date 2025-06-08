<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

//Middlewares
use App\Http\Middleware\Admin\EnsureEmailIsVerified as AdminEnsureEmailIsVerified;
use App\Http\Middleware\Barber\EnsureEmailIsVerified as BarberEnsureEmailIsVerified;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin.verified' => AdminEnsureEmailIsVerified::class,
            'barber.verified' => BarberEnsureEmailIsVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();