<?php

namespace App\Http\Requests\Client\Resources\Payment;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
{
    // Para pruebas rápidas:
    // return true;

    // O con tu guard de clientes:
    return true;
}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
        'reservation_id' => ['required','integer','exists:reservations,id'],
        'amount'         => ['required','numeric','min:0.1'],
        ];
    }
}
