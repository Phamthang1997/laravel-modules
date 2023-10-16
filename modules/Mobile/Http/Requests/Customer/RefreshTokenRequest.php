<?php

namespace Modules\Mobile\Http\Requests\Customer;

use Modules\Mobile\Http\Requests\BaseRequest;

/**
 * @property string $refresh_token
 */
class RefreshTokenRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'refresh_token' => ['required', 'string'],
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
            'refresh_token.required' => __('mobile::validation.required'),
            'refresh_token.string' => __('mobile::validation.email'),
        ];
    }
}
