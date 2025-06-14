<?php

namespace App\Http\Controllers\Barber;

use App\Http\Controllers\Controller;

# From Request para actualizar el perfil
use App\Http\Requests\Barber\ProfileUpdateRequest;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

use App\Models\Specialty;
class ProfileController extends Controller
{

    # Se envia a la vista para editar perfil
    public function edit(Request $request): View
    {
        return view('barber.profile.edit', [
            'user' => Auth::guard('barber')->user(),
            'specialties' => Specialty::all(),
        ]);
    }

    # Se procesa la edición del perfil
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $barber = Auth::guard('barber')->user();
        $data = $request->validated();

        # Manejo de nueva imagen de perfil
        if ($request->hasFile('profile_photo')) {
            if ($barber->profile_photo && Storage::disk('public')->exists($barber->profile_photo)) {
                Storage::disk('public')->delete($barber->profile_photo);
            }

            $data['profile_photo'] = $request->file('profile_photo')->store('barbers/profile_photos', 'public');
        }

        $barber->fill($data);

        if ($barber->isDirty('email')) {
            $barber->email_verified_at = null;
        }

        $barber->save();

        if (array_key_exists('specialties', $data)) {
            $barber->specialties()->sync($data['specialties']);
        }

        return Redirect::route('barber.profile.edit')->with('status', 'profile-updated');
    }
}
