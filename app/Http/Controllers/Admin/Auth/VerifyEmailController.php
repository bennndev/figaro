<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user('admin')->hasVerifiedEmail()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        if ($request->user('admin')->markEmailAsVerified()) {
            event(new Verified($request->user('admin')));
        }

        return redirect()->intended(route('admin.dashboard'))->with('verified', true);
    }
}
