<?php

namespace Modules\Mobile\Http\Requests\Authentication\Password;

use Modules\Mobile\Http\Requests\BaseRequest;

/**
 * @property string $token
 */
class VerifyRequest extends BaseRequest
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
        ];
    }
}
