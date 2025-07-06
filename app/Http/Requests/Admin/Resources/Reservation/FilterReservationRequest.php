<?php

namespace App\Http\Requests\Admin\Resources\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class FilterReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Filtro por nombre/apellido del cliente
            'client_name' => 'nullable|string|max:255',
            
            // Filtro por nombre/apellido del barbero
            'barber_name' => 'nullable|string|max:255',
            
            // Filtro por fecha específica
            'reservation_date' => 'nullable|date',
            
            // Filtro por estado
            'status' => 'nullable|string|in:pending,paid,completed,cancelled',
        ];
    }
}
