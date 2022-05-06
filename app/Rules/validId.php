<?php

namespace App\Rules;

use App\Services\LuhnValidation\isValidId;
use Illuminate\Contracts\Validation\Rule;

class validId implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $idNumber = new isValidId($value);
        return $idNumber->valid();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This is not a valid South African ID number.';
    }
}
