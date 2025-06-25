<?php

namespace App\Http\Requests\Client\Resources\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reservation_date' => 'required|date|after:today',
            'reservation_time' => 'required|date_format:H:i',
            'barber_id' => 'required|exists:barbers,id',
            'note' => 'nullable|string|max:255',
        
            'services' => 'required|array|min:1',
            'services.*' => 'exists:services,id',
        ];
    }
}
