<?php

namespace Modules\Customer\Http\Requests\Authentication\Password;

use Modules\Customer\Http\Requests\BaseRequest;

class ForgotRequest extends BaseRequest
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
        ];
    }
}
