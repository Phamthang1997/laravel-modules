<?php

namespace Modules\Administrator\Http\Requests\Authentication;

use Modules\Administrator\Http\Requests\BaseRequest;

/**
 * @property string $email
 * @property string $password
 */
class LoginRequest extends BaseRequest
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
            'email.required' => __('administrator::validation.required'),
            'email.email' => __('administrator::validation.email'),

            'password.required' => __('administrator::validation.required'),
            'password.email' => __('administrator::validation.email'),
            'password.min' => __('administrator::validation.min.string'),
        ];
    }
}
