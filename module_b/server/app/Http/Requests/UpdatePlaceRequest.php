<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlaceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'min:1',
            'type' => 'min:1',
            'latitude' => 'min:1',
            'longitude' => 'min:1',
            'image' => 'image',
            'open_time' => 'time',
            'close_time' => 'time',
            'description' => 'min:1',
        ];
    }
}
