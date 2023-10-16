<?php

namespace Modules\Mobile\Http\Requests\Customer;

use Modules\Mobile\Http\Requests\BaseRequest;

class CreateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email'],
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
            'name.required' => __('customer::validation.required'),
            'name.string' => __('customer::validation.string'),
            'name.max' => __('customer::validation.max.string'),

            'email.required' => __('customer::validation.required'),
            'email.string' => __('customer::validation.string'),
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
