<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AccountMangerRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (in_array(request()->get('role_id'),[5,6])  && empty(request()->get($attribute))){
            $fail((request()->get('role_id') ==5?'Telesale':'Account Manager ').' field is required.');
        }

    }
}
