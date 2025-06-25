<?php

namespace App\Http\Requests\Client\Resources\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class FilterReservationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
            'service_ids' => 'nullable|array',
            'service_ids.*' => 'exists:services,id',
        ];
    }
}
