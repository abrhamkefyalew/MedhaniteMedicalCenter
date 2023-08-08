<?php

namespace App\Http\Requests\Api\V1\AuthRequests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LoginCustomerForMedhaniteOldRequest extends FormRequest
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
            'first_name' => [
                'sometimes', 'string', 'regex:/^\S*$/u', 'alpha',
            ],
            'last_name' => [
                'sometimes', 'string', 'regex:/^\S*$/u', 'alpha',
            ],
            'email' => [
                'sometimes', 'email', Rule::unique('customers'),
            ],
            'phone_number' => [
                'required', 'numeric',  
                // Rule::unique('customers'), // since there is also login this should not be unique
            ],
            'is_active' => [
                'sometimes', 'nullable', 'boolean',
            ],
            'is_approved' => [
                'sometimes', 'nullable', 'boolean',
            ],
        ];
    }
}
