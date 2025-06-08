<?php

namespace App\Http\Requests\Admin\Resources\Service;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return (new CreateServiceRequest())->rules();
    }
}
