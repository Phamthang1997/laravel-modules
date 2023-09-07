<?php

namespace Modules\Administrator\Http\Requests\Authentication\Password;

use Modules\Administrator\Http\Requests\BaseRequest;

/**
 * @property string $token
 * @property string $email
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
