<?php

namespace App\Http\Validators;

abstract class BaseValidator
{
    protected $field;

    protected $errors = [];

    public function getErrorsMessages()
    {
        return $this->errors;
    }

    public function getFirstError()
    {
        return $this->errors[0];
    }

    public function setError($error)
    {
        $this->errors[] = $error;
    }

    public function __construct($field)
    {
        $this->field = $field;
    }

    public abstract function validate();
}