<?php

namespace App\Http\Requests\Client\Resources\Barber;

use Illuminate\Foundation\Http\FormRequest;

class FilterBarberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
