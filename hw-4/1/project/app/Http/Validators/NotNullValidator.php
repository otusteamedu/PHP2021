<?php

namespace App\Http\Validators;

class NotNullValidator extends BaseValidator
{
    public function validate()
    {
        return empty($this->field) ? false : true;
    }
}