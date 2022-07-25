<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AllImages implements Rule
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
        $allowedfileExtension=['jpeg','JPEG','jpg','JPG','png','PNG'];
        foreach ($value as $key => $scan) {
            $extension = $scan->getClientOriginalExtension();
            $res = in_array($extension,$allowedfileExtension);
            $check[$key] = $res;
        }

        if (in_array(false, $check)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Les scans doivent tous être envoyés au format JPEG, JPG ou PNG';
    }
}
