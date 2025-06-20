<?php

namespace App\Http\Controllers\Barber\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        if ($request->user('barber')->hasVerifiedEmail()) {
            return redirect()->intended(route('barber.dashboard', absolute: false));
        }

        $request->user('barber')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
