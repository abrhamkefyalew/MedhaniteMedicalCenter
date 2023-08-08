<?php

namespace App\Http\Requests\Api\V1\AdminRequests;

use App\Models\Doctor;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Doctor::class);
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
            // doctor Info
            'hospital_id' => 'integer|exists:hospitals,id', // abrham comment for the future if needed , make this array, to accept multiple hospital ids, so that a doctor can register belonging multiple hospitals at once
            'first_name' => [
                'required', 'string', 'regex:/^\S*$/u', 'alpha',
            ],
            'last_name' => [
                'required', 'string', 'regex:/^\S*$/u', 'alpha',
            ],
            'email' => [
                'required', 'email', Rule::unique('doctors'),
            ],
            'phone_number' => [
                'nullable', 'numeric',  Rule::unique('doctors'),
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
            'doctor_medical_license_image' => [
                'sometimes',
                'image',
                'max:3072',
            ],

            // since it is Storing Doctor for the first time there is no need to remove any image, so we do NOT need remove_image
            // also when doing remove image try to do it for specific collection
            // 'remove_image' => [
            //     'sometimes', 'boolean',
            // ],

            // specialities for the doctor
            'speciality_ids' => 'sometimes|array',
            'speciality_ids.*' => 'integer|exists:specialities,id',
        ];
    }
}
