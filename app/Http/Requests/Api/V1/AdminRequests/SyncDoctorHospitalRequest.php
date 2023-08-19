<?php

namespace App\Http\Requests\Api\V1\AdminRequests;

use App\Models\DoctorHospital;
use Illuminate\Foundation\Http\FormRequest;

class SyncDoctorHospitalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('sync', DoctorHospital::class);
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
            'doctor_ids' => 'sometimes|array',
            'doctor_ids.*' => 'integer|exists:doctors,id',
        ];
    }
}
