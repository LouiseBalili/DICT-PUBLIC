<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewOfficeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'office_name' => ['required', 'string', 'unique:offices'],
            'location' => ['required', 'string'],
            'classification' => ['required', 'string'],
        ];
    }
}
