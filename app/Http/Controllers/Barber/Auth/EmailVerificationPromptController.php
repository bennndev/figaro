<?php

namespace App\Http\Controllers\Barber\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user('barber')->hasVerifiedEmail()
                    ? redirect()->intended(route('barber.dashboard', absolute: false))
                    : view('barber.auth2.verify-email');
    }
}
