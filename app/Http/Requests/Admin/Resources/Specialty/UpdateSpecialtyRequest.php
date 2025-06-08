<?php

namespace App\Http\Requests\Admin\Resources\Specialty;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpecialtyRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return (new CreateSpecialtyRequest())->rules();
    }
}
