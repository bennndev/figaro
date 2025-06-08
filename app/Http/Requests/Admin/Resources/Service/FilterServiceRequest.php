<?php

namespace App\Http\Requests\Admin\Resources\Service;

use Illuminate\Foundation\Http\FormRequest;

class FilterServiceRequest extends FormRequest
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
