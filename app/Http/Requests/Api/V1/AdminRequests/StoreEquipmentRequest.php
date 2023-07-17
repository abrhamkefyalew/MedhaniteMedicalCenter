<?php

namespace App\Http\Requests\Api\V1\AdminRequests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEquipmentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // equipment_type_id
            'equipment_type_id' => 'exists:equipment_types,id',
            'equipment_name' => ['required', 'string', 'unique:equipment,equipment_name'],
            'equipment_description' => ['sometimes', 'string'],
        ];
    }
}
