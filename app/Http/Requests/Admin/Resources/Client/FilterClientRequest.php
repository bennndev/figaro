<?php

namespace App\Http\Requests\Admin\Resources\Client;

use Illuminate\Foundation\Http\FormRequest;

class FilterClientRequest extends FormRequest
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
        ];  
    }
}
