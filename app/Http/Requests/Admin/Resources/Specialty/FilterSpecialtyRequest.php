<?php

namespace App\Http\Requests\Admin\Resources\Specialty;

use Illuminate\Foundation\Http\FormRequest;

class FilterSpecialtyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',    
        ];
    }
}
