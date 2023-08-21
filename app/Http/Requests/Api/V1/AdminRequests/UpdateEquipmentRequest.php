<?php

namespace App\Http\Requests\Api\V1\AdminRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEquipmentRequest extends FormRequest
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
            //
            'equipment_type_id' => 'sometimes|integer|exists:equipment_types,id',
            'equipment_name' => ['sometimes', 'string', 'unique:equipment,equipment_name' . $this->equipment->id], // ignore this equipment row (with this id) while checking uniqueness
            'equipment_description' => ['sometimes', 'string'],
        ];
    }
}
