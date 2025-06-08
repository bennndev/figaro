<?php

namespace App\Http\Controllers\Barber\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {

        if ($request->user('barber')->hasVerifiedEmail()) {
            return redirect()->intended(route('barber.dashboard'));
        }

        if ($request->user('barber')->markEmailAsVerified()) {
            event(new Verified($request->user('barber')));
        }

        return redirect()->intended(route('barber.dashboard'))->with('verified', true);
    }
}
