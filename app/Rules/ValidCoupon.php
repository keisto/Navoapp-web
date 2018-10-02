<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Stripe\Coupon;
use Exception;

class ValidCoupon implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            Coupon::retrieve($value);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Coupon not valid.';
    }
}
