<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\Client\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

# Manejo de imagenes
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('client.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $data = $request->validated();

        // Si el usuario quiere quitar la foto actual
        if ($request->has('remove_photo') && $user->profile_photo) {
            // Solo borrar si es una imagen local, no una URL externa
            if (!filter_var($user->profile_photo, FILTER_VALIDATE_URL) &&
                Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $user->profile_photo = null;
        }

        // Si el usuario sube una nueva foto
        if ($request->hasFile('profile_photo')) {
            // Borrar la anterior solo si es local (no URL)
            if ($user->profile_photo && !filter_var($user->profile_photo, FILTER_VALIDATE_URL) &&
                Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Guardar la nueva imagen
            $data['profile_photo'] = $request->file('profile_photo')->store('clients/profile_photos', 'public');
        }

        $user->fill($data);

        // Si cambió el email, marcar como no verificado
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::guard('web')->logout();

        $user->delete();

        // Usar el mismo patrón que admin y barber
        $request->session()->forget('web_session');
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
