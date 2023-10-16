<?php

namespace Modules\Mobile\Http\Requests\Authentication\Password;

use Modules\Mobile\Http\Requests\BaseRequest;

/**
 * @property string $token
 * @property string $password
 * @property string $confirm_password
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
            'token' => ['required', 'numeric', 'digits:6'],
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
            'token.required' => __('mobile::validation.required'),
            'token.numeric' => __('mobile::validation.numeric'),
            'token.digits' => __('mobile::validation.digits'),

            'password.required' => __('mobile::validation.required'),
            'password.string' => __('mobile::validation.string'),
            'password.min' => __('mobile::validation.min.string'),

            'confirm_password.required' => __('mobile::validation.required'),
            'confirm_password.string' => __('mobile::validation.string'),
            'confirm_password.min' => __('mobile::validation.min.string'),
            'confirm_password.same' => __('mobile::validation.same'),
        ];
    }
}
