<?php

namespace App\Http\Requests\Client\Resources\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class AvailableSlotsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'barber_id' => 'required|exists:barbers,id',
            'schedule_id' => 'required|exists:schedules,id',
            'services' => 'required|array|min:1',
            'services.*' => 'exists:services,id',
        ];
    }
}
