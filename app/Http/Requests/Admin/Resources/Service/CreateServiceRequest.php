<?php

namespace App\Http\Requests\Admin\Resources\Service;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends FormRequest
{

    function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'required', 'string', 'max:255'],
            'image' => ['sometimes', 'required', 'image', 'max:2048'],
            'duration_minutes' => ['sometimes', 'required', 'integer', 'min:15'],
            'price' => ['sometimes', 'required', 'numeric', 'min:10', 'max:999.99'],

            # Especialidades
            'specialties' => ['required', 'array','min:1'],
            'specialties.*' => ['required', 'integer','exists:specialties,id'],
        ];
    }
}
