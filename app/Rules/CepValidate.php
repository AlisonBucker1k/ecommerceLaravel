<?php

namespace App\Rules;

use Exception;
use Illuminate\Contracts\Validation\Rule;

class CepValidate implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            $info = zipcode($value);
        } catch (Exception $e) {
            return false;
        }

        return empty($info);   
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'CEP não localizado.';
    }
}
