<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use File;

class PhotoExist implements Rule
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
        return File::exists(public_path("uploads/import_images/".$value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute should be exist in import image folder';
    }
}
