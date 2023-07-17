<?php

namespace App\Http\Requests\Api\V1\AdminRequests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHospitalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->hospital);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // Hospital Info
            'hospital_name' => [
                'required', 'string',
            ],
            'hospital_description' => [
                'sometimes', 'string', 'nullable',
            ],
            // 'hospital_email' => [
            //     'sometimes', 'email', Rule::unique('hospitals'),
            // ],
            'hospital_phone_number' => [
                'sometimes', 'nullable', 'numeric', Rule::unique('hospitals')->ignore($this->user()->id),
            ],
            'hospital_is_active' => [
                'sometimes', 'nullable', 'boolean',
            ],
            'hospital_is_approved' => [
                'sometimes', 'nullable', 'boolean',
            ],
            'hospital_working_hours' => [
                'sometimes',
                'array',
            ],
            'hospital_working_hours.*' => [
                'sometimes',
                'string',
            ],
            'hospital_relative_location' => [
                'sometimes',
                'array',
            ],
            'hospital_relative_location.*' => [
                'sometimes', 
                'string',
            ],
            'hospital_latitude' => [
                'sometimes', 'numeric', 'between:-90,90',
            ],
            'hospital_longitude' => [
                'sometimes', 'numeric', 'between:-180,180',
            ],
            'hospital_country' => [
                'sometimes', 'string',
            ],
            'hospital_city' => [
                'sometimes', 'string',
            ],
            'hospital_nigd_fikad_image' => [
                'sometimes',
                'image',
                'max:3072',
            ],
            'hospital_tin_number_image' => [
                'sometimes',
                'image',
                'max:3072',
            ],
            'hospital_tiena_tibeka_image' => [
                'sometimes',
                'image',
                'max:3072',
            ],
            'hospital_profile_image' => [
                'sometimes',
                'image',
                'max:3072',
            ],
            
            // and also when removing image, we should also provide the collection to remove only specific collection SEPARATELY, like, nigd_fikad or tin_number
            'hospital_nigd_fikad_image_remove' => [
                'sometimes', 'boolean',
            ],
            'hospital_tin_number_image_remove' => [
                'sometimes', 'boolean',
            ],
            'hospital_tiena_tibeka_image_remove' => [
                'sometimes', 'boolean',
            ],
            'hospital_profile_image_remove' => [
                'sometimes', 'boolean',
            ],
        ];
    }
}
