<?php

namespace App\Http\Controllers\Barber\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Barber\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    
    # Se envia al formulario de login
    public function create(): View
    {
        return view('barber.auth.login');
    }

    # Se procesan los datos de logueo y se envia al dashbaord si son correctos.
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('barber.dashboard', absolute: false));
    }

   # Cierre de sesión
    public function destroy(Request $request): RedirectResponse
    {
        # Asignamos el guard corerspondiente del modelo
        Auth::guard('barber')->logout();

        # Cerramos la sesión correspondiente del modelo
        $request->session()->forget('barber_session');
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
