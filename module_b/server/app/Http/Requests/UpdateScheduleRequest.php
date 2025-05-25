<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
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
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'line' => 'min:1',
            'from_place_id' => 'min:1',
            'to_place_id' => 'min:1',
            'departure_time' => 'date_format:H:i:s',
            'arrival_time' => 'date_format:H:i:s',
            'distance' => 'min:1',
            'speed' => 'min:1',
        ];
    }
}
