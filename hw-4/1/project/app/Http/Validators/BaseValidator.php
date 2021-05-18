<?php

namespace App\Http\Validators;

abstract class BaseValidator
{
    protected $field;

    public function __construct($field)
    {
        $this->field = $field;
    }

    public abstract function validate();
}