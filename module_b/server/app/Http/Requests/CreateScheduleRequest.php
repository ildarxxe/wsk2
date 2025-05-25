<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateScheduleRequest extends FormRequest
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
            'departure_time' => 'required|date_format:H:i:s',
            'arrival_time' => 'required|date_format:H:i:s',
            'distance' => 'required',
            'speed' => 'required',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $departure_time = Carbon::createFromFormat('H:i:s', $this->departure_time);
            $arrival_time = Carbon::createFromFormat('H:i:s', $this->arrival_time);
            if ($departure_time->greaterThan($arrival_time)) {
                $validator->errors()->add('arrival_time', 'arrival_time must be after departure_time');
            }

            $startTime = Carbon::createFromFormat('H:i', '08:30');
            $lastTime = Carbon::createFromFormat('H:i', '18:00');
            if (!($departure_time->between($startTime, $lastTime))) {
                $validator->errors()->add('departure_time', 'departure_time must be in range 08:30 - 18:00');
            }
            if (!($arrival_time->between($startTime, $lastTime))) {
                $validator->errors()->add('arrival_time', 'arrival_time must be in range 08:30 - 18:00');
            }
        });
    }
}
