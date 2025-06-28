<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    
    # Se envia al formulario de login
    public function create(): View
    {
        return view('admin.auth2.login');
    }

    # Se procesan los datos de logueo y se envia al dashbaord si son correctos.
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        
        $admin = auth('admin')->user();

        # Redireccionar según el estado de su email
        if (! $admin->hasVerifiedEmail()) {
            return redirect()->route('admin.verification.notice');
        }

        return redirect()->intended(route('admin.dashboard'));
    }

   # Cierre de sesión
    public function destroy(Request $request): RedirectResponse
    {
        $user = auth('admin')->user();

        #Destruir el token de verificación cada que se cierra sesión
        if ($user) {
            $user->email_verified_at = null;
            $user->save();

            logger('Email verification reset for user id: ' . $user->id);
        }
        # Asignamos el guard corerspondiente del modelo
        Auth::guard('admin')->logout();

        # Cerramos la sesión correspondiente del modelo
        $request->session()->forget('admin_session');
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
