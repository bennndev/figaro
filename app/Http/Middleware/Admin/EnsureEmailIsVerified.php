<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user('admin') ||
            ! $request->user('admin')->hasVerifiedEmail()) {
            return $request->expectsJson()
                ? abort(403, 'Email no verificado.')
                : Redirect::route('admin.verification.notice');
        }

        return $next($request);
    }
}