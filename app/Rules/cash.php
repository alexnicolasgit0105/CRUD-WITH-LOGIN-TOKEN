<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class cash implements Rule
{

    public $error;
    public $data = [];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
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
        $totalCash   = 0;

        foreach ($value as $key => $cash) {
            $totalCash = $totalCash + $cash;
        }

        if (!$totalCash) {
            $this->error = ':attribute should not be empty';
            return false;
        }

        $totalQ   = 0;

        foreach ($this->data['quantity'] as $key => $quantity) {
            $totalQ = $totalQ + $quantity;
        }

        if ($totalQ) {
            $total = $totalQ * $totalCash;    
        }
        
        if ($total > 10000) {
            $this->error = ':attribute should not be greater than 10000';
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
         return $this->error;
    }
}
