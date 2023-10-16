<?php

namespace Modules\Customer\Http\Requests\Authentication\Password;

use Modules\Customer\Http\Requests\BaseRequest;

/**
 * @property string $email
 * @property string $token
 */
class TokenRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'token' => [''],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [];
    }
}
