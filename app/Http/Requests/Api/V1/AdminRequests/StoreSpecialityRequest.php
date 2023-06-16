<?php

namespace App\Http\Requests\Api\V1\AdminRequests;

use App\Models\Speciality;
use Illuminate\Foundation\Http\FormRequest;

class StoreSpecialityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Speciality::class);
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
            'speciality_name' => ['required', 'string', 'unique:specialities,speciality_name'],
            'speciality_description' => ['sometimes', 'string'],
        ];
    }
}
