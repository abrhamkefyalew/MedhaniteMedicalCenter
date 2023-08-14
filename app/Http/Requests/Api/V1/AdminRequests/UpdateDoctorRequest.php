<?php

namespace App\Http\Requests\Api\V1\AdminRequests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->doctor);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // doctor info
            'first_name' => [
                'sometimes', 'string', 'regex:/^\S*$/u', 'alpha',
            ],
            'last_name' => [
                'sometimes', 'string', 'regex:/^\S*$/u', 'alpha',
            ],
            'phone_number' => [
                'nullable', 'numeric',  Rule::unique('doctors')->ignore($this->doctor->id),
            ],
            'is_active' => [
                'sometimes', 'nullable', 'boolean',
            ],
            'is_approved' => [
                'sometimes', 'nullable', 'boolean',
            ],
            // 'password' => [
            //     'sometimes', 'min:8', 'confirmed',
            // ],
            'country' => [
                'sometimes', 'string',
            ],
            'city' => [
                'sometimes', 'string',
            ],
            'profile_image' => [
                'sometimes',
                'image',
                'max:3072',
            ],
            'doctor_medical_license_image' => [
                'sometimes',
                'image',
                'max:3072',
            ],

            // and also when removing image, we should also provide the collection to remove only specific collection SEPARATELY, like, profile_image or cover_image_remove
            'profile_image_remove' => [
                'sometimes', 'boolean',
            ],

            'doctor_medical_license_image_remove' => [
                'sometimes', 'boolean',
            ],

            // for doctor hospitals
            'hospital_ids' => 'sometimes|array',
            'hospital_ids.*' => 'integer|exists:hospitals,id',

            // specialities for the doctor
            'speciality_ids' => 'sometimes|array',
            'speciality_ids.*' => 'integer|exists:specialities,id',
        ];
    }
}
