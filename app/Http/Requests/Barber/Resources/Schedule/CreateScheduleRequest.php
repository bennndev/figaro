<?php

namespace App\Http\Requests\Barber\Resources\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class CreateScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'date'  => 'required|date_format:Y-m-d|after_or_equal:today',
            'start_time'     => 'required|date_format:H:i|before:end_time',
            'end_time'       => 'required|date_format:H:i|after:start_time',
        ];
    }
}



