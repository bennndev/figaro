<?php

namespace App\Http\Requests\Admin\Resources\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return (new CreateScheduleRequest())->rules();
    }
}
