<?php

namespace Modules\Mobile\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class AuthenticateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [
            'email.required' => __('customer::validation.required'),
            'email.email' => __('customer::validation.email'),

            'password.required' => __('customer::validation.required'),
            'password.email' => __('customer::validation.email'),
            'password.min' => __('customer::validation.min.string'),
        ];
    }
}
