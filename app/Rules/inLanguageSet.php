<?php

namespace App\Rules;

use App\Models\Language;
use Illuminate\Contracts\Validation\Rule;

class inLanguageSet implements Rule
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
        $languageSet = Language::all()->pluck('id')->toArray();

        return in_array($value, $languageSet);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This is not a valid language.';
    }
}
