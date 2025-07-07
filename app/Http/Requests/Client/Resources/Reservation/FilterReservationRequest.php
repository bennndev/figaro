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
            // Filtro por nombre/apellido del cliente
            'client_name' => 'nullable|string|max:255',
            
            // Filtro por nombre/apellido del barbero
            'barber_name' => 'nullable|string|max:255',
            
            // Filtro por fecha específica
            'reservation_date' => 'nullable|date',
            
            // Filtro por rango de fechas
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date|after_or_equal:date_from',
            
            // Filtro por estado
            'status' => 'nullable|string|in:pending,paid,completed,cancelled',
        ];
    }

    public function messages(): array
    {
        return [
            'client_name.string' => 'El nombre del cliente debe ser texto.',
            'client_name.max' => 'El nombre del cliente no puede superar los 255 caracteres.',
            'barber_name.string' => 'El nombre del barbero debe ser texto.',
            'barber_name.max' => 'El nombre del barbero no puede superar los 255 caracteres.',
            'reservation_date.date' => 'La fecha de reserva debe ser una fecha válida.',
            'date_from.date' => 'La fecha desde debe ser una fecha válida.',
            'date_to.date' => 'La fecha hasta debe ser una fecha válida.',
            'date_to.after_or_equal' => 'La fecha hasta debe ser posterior o igual a la fecha desde.',
            'status.in' => 'El estado seleccionado no es válido.',
        ];
    }

    public function attributes(): array
    {
        return [
            'client_name' => 'nombre del cliente',
            'barber_name' => 'nombre del barbero',
            'reservation_date' => 'fecha de reserva',
            'date_from' => 'fecha desde',
            'date_to' => 'fecha hasta',
            'status' => 'estado',
        ];
    }
}
