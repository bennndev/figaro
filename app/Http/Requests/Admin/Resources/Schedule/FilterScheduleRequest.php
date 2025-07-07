<?php

namespace App\Http\Requests\Admin\Resources\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class FilterScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'barber_name' => ['nullable', 'string'],
            'date' => ['nullable', 'date'],
        ];
    }
}
