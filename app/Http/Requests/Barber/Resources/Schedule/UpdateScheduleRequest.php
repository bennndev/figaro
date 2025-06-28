<?php

namespace App\Http\Requests\Barber\Resources\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' =>'sometimes|string|max:255',
            'date'  => 'sometimes|date_format:Y-m-d',
            'start_time'     => 'sometimes|date_format:H:i|before:end_time',
            'end_time'       => 'sometimes|date_format:H:i|after:start_time',
            'status'         => 'sometimes|in:available,booked',
        ];
    }
}
