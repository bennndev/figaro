<?php

namespace App\Http\Requests\Admin\Resources\Barber;

use Illuminate\Foundation\Http\FormRequest;

class FilterBarberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'specialty_id' => 'nullable|exists:specialties,id',
        ];
    }
}