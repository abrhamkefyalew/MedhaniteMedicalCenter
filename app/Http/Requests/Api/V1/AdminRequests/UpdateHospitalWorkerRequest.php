<?php

namespace App\Http\Requests\Api\V1\AdminRequests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHospitalWorkerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->hospitalWorker);
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
            'first_name' => [
                'required', 'string', 'regex:/^\S*$/u', 'alpha',
            ],
            'last_name' => [
                'required', 'string', 'regex:/^\S*$/u', 'alpha',
            ],
            // 'email' => [
            //     'required', 'email', Rule::unique('hospital_workers'),
            // ],
            'phone_number' => [
                'nullable', 'numeric',  Rule::unique('hospital_workers')->ignore($this->user()->id),
            ],
            'job_title' => [
                'sometimes', 'string',
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

            // and also when removing image, we should also provide the collection to remove only specific collection SEPARATELY, like, profile_image or cover_image_remove
            'profile_image_remove' => [
                'sometimes', 'boolean',
            ],
            //
            // while updating hospital worker roles a person should not update his own role, 
            // the hospital worker admin admin only should update other hospital worker roles but NOT his own
            // the medhanite super admin can change any hospital workers role (but NOT recommended)
            'hospital_worker_role_ids' => 'required|array',
            'hospital_worker_role_ids.*' => 'exists:hospital_roles,id',
        ];
    }
}
