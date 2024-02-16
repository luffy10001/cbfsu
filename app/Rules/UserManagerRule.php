<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserManagerRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail):void
    {
        if(!in_array($value,[5,6,14,13,12,11,9,10]) && empty(request()->get($attribute))){
            $fail("Reporting manager role is required");
        }
    }
}
