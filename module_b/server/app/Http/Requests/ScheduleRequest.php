<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ScheduleRequest extends FormRequest
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
            'line' => 'required',
            'from_place_id' => 'required',
            'to_place_id' => 'required',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i',
            'distance' => 'required',
            'speed' => 'required',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $departureTime = $this->input('departure_time');
            $arrivalTime = $this->input('arrival_time');

            if ($departureTime && $arrivalTime) {
                $departure = Carbon::createFromFormat('H:i', $departureTime);
                $arrival = Carbon::createFromFormat('H:i', $arrivalTime);

                if ($arrival && $departure && $arrival->greaterThan($departure)) {
                    $validator->errors()->add('arrival_time', 'Время прибытия не должно быть позже времени отправления.');
                }
            }
        });
    }
}
