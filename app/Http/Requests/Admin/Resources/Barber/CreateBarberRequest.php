<?php

namespace App\Http\Requests\Admin\Resources\Barber;

use Illuminate\Foundation\Http\FormRequest;

class CreateBarberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:barbers,email'],
            'phone_number' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', 'min:8'],
            'profile_photo' => ['required', 'image', 'max:2048'],
            'description' => ['required', 'string', 'max:1000'],
            'specialty_ids' => ['required', 'array', 'min:1'],
            'specialty_ids.*' => ['exists:specialties,id'],
        ];
    }
}

