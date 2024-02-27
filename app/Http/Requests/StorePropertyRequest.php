<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
            'property_no' => 'string|required|unique:properties',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'description' => 'string|required',
            'serial_no' => 'required|unique:properties',
            'measurement_unit' => 'required',
            'unit_value' => 'numeric|required',
            'acquisition_id' => 'required',
            'received_from' => 'required',
            'office_id' => 'required',
            'assigned_to' => 'required',
            'date_acquired' => 'date|required',
            'status' => 'in:Serviceable,Unserviceable|required',
        ];
    }
}
