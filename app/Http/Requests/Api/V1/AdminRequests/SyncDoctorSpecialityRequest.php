<?php

namespace App\Http\Requests\Api\V1\AdminRequests;

use App\Models\DoctorSpeciality;
use Illuminate\Foundation\Http\FormRequest;

class SyncDoctorSpecialityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('sync', DoctorSpeciality::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'speciality_ids' => 'sometimes|array',
            'speciality_ids.*' => 'integer|exists:specialities,id',
        ];
    }
}
