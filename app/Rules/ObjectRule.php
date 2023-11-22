<?php

namespace App\Rules;

class ObjectRule
{
    public function passes($attribute, $value)
    {
        return is_object($value);
    }

    public function message()
    {
        return 'The :attribute must be an object.';
    }
}
