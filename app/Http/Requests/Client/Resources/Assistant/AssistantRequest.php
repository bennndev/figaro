<?php

namespace App\Http\Requests\Client\Resources\Assistant;

use Illuminate\Foundation\Http\FormRequest;

class AssistantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prompt' => [
                'required',
                'string',
                'max:1000',
                function ($attribute, $value, $fail) {
                    if (str_word_count($value) < 3) {
                        $fail('Por favor escribe una pregunta más detallada (mínimo 3 palabras)');
                    }
                }
            ]
        ];
    }

    public function messages()
    {
        return [
            'prompt.required' => 'El campo pregunta es obligatorio',
            'prompt.max' => 'La pregunta no debe exceder los 1000 caracteres'
        ];
    }
}