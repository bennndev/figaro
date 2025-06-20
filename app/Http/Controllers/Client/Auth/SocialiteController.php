<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'last_name' => '',
                    'phone_number' => null,
                    'profile_photo' => $googleUser->getAvatar(), // Si tienes esto
                    'password' => bcrypt(str()->random(16)), // Contraseña segura aleatoria
                    'email_verified_at' => now(),
                ]
            );

            Auth::login($user);

            return redirect()->intended(route('dashboard'));

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'email' => 'No se pudo iniciar sesión con Google.',
            ]);
        }
    }
}
