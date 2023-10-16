<?php

namespace Modules\Customer\Http\Requests\Authentication\Password;

use Modules\Customer\Http\Requests\BaseRequest;

/**
 * @property string $email
 * @property string $token
 * @property string $password
 */
class ResetRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'string', 'min:8','same:password'],
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
            'token.required' => __('customer::validation.required'),

            'email.required' => __('customer::validation.required'),
            'email.email' => __('customer::validation.email'),

            'password.required' => __('customer::validation.required'),
            'password.string' => __('customer::validation.string'),
            'password.min' => __('customer::validation.min.string'),

            'confirm_password.required' => __('customer::validation.required'),
            'confirm_password.string' => __('customer::validation.string'),
            'confirm_password.min' => __('customer::validation.min.string'),
            'confirm_password.same' => __('customer::validation.same'),
        ];
    }
}
