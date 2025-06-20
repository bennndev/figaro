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
            'note' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
        ];
    }
}
