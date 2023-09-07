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
            'token.required' => __('administrator::validation.required'),
            'token.numeric' => __('administrator::validation.numeric'),
            'token.digits' => __('administrator::validation.digits'),

            'password.required' => __('administrator::validation.required'),
            'password.string' => __('administrator::validation.string'),
            'password.min' => __('administrator::validation.min.string'),

            'confirm_password.required' => __('administrator::validation.required'),
            'confirm_password.string' => __('administrator::validation.string'),
            'confirm_password.min' => __('administrator::validation.min.string'),
            'confirm_password.same' => __('administrator::validation.same'),
        ];
    }
}
