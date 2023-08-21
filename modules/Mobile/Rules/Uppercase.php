<?php

namespace Modules\Mobile\Rules;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\ValidationRule;

class Uppercase implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /** @phpstan-ignore-next-line */
        if (Str::upper($value) !== $value) {
            $fail('The :attribute must be uppercase.');
        }
    }
}
