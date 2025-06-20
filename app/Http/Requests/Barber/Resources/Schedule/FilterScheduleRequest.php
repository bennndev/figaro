<?php

namespace App\Http\Requests\Barber\Resources\Schedule;

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
            'date' => 'nullable|date_format:Y-m-d',
            'status' => 'nullable|in:available,booked',
            'start_time' => 'nullable|date_format:H:i',
        ];
    }
}
