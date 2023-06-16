<?php

namespace App\Http\Requests\Api\V1\AdminRequests;

use App\Models\Hospital;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreHospitalWithHospitalAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Hospital::class);
        // abrham comment
        // for the future make authorize check hospital create and hospital worker create at the same time in policy
        // and return one boolean 
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
            'hospital_email' => [
                'sometimes', 'email', Rule::unique('hospitals'),
            ],
            'hospital_phone_number' => [
                'sometimes', 'nullable', 'numeric', Rule::unique('hospitals'),
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
            // since it is Storing Hospital for the first time there is no need to remove any image // so we do NOT need remove_image
            // and also when removing image, we should also provide the collection to remove only specific collection like, nigd_fikad or tin_number
            // 'hospital_remove_image' => [
            //     'sometimes', 'boolean',
            // ],


            // Hospital Worker Info
            'first_name' => [
                'required', 'string', 'regex:/^\S*$/u', 'alpha',
            ],
            'last_name' => [
                'required', 'string', 'regex:/^\S*$/u', 'alpha',
            ],
            'email' => [
                'required', 'email', Rule::unique('hospital_workers'),
            ],
            'phone_number' => [
                'nullable', 'numeric',  Rule::unique('hospital_workers'),
            ],
            'job_title' => [
                'required', 'string',
            ],
            'is_active' => [
                'sometimes', 'nullable', 'boolean',
            ],
            'is_approved' => [
                'sometimes', 'nullable', 'boolean',
            ],
            'password' => [
                'required', 'min:8', 'confirmed',
            ],
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

            // since it is Storing Hospital Worker for the first time there is no need to remove any image, so we do NOT need remove_image
            // 'remove_image' => [
            //     'sometimes', 'boolean',
            // ],
            //
            // we do not need to send hospital worker role on first registration of hospital, 
            // so by default the hospital worker role is hospital admin admin
            // 'hospital_worker_role_ids' => 'required|array',
            // 'hospital_worker_role_ids.*' => 'exists:hospital_roles,id',
        ];
    }
}
