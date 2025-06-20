<?php

namespace App\Http\Requests\Admin\Resources\Barber;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBarberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'profile_photo' => ['nullable', 'image', 'max:2048'], 
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'], 
            'description' => ['nullable', 'string'],
            'specialty_ids' => ['required', 'array', 'min:1'],
            'specialty_ids.*' => ['exists:specialties,id'],
        ];
    }
}

