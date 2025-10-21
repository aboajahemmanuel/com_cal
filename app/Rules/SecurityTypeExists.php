<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\SecurityType;

class SecurityTypeExists implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the value exists in the SecurityType table
        return SecurityType::where('id', $value)->exists();
    }

    public function message()
    {
        return 'The selected security type does not exist.';
    }
}
