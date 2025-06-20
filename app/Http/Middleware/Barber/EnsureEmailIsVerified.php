<?php

namespace App\Http\Middleware\Barber;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user('barber') ||
            ! $request->user('barber')->hasVerifiedEmail()) {
            return $request->expectsJson()
                ? abort(403, 'Email no verificado.')
                : Redirect::route('barber.verification.notice');
        }

        return $next($request);
    }
}