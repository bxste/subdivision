<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidPhilippineNumber implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the value is a valid Philippine mobile number
        return preg_match("/((\+[0-9]{2})|0)[.\- ]?9[0-9]{2}[.\- ]?[0-9]{3}[.\- ]?[0-9]{4}/", $value);
    }

    public function message()
    {
        return 'The :attribute must be a valid Philippine mobile number.';
    }
}

