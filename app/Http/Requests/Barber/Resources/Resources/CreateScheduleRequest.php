<?php

namespace App\Http\Requests\Barber\Resources\Resources;

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
            'schedule_time' =>'required|date_format:H:i:s',
            'schedule_date' =>'required|string',
            'start_time' => 'required|',
            'end_time' => 'required|string',
        ];
    }
}



