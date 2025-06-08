<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
        'name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id)],
        'phone' => ['nullable', 'string', 'max:20'],
        'profile_photo' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
