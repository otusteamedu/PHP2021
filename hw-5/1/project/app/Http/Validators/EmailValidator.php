<?php

namespace App\Http\Validators;

class EmailValidator extends BaseValidator
{
    public function validate()
    {
        if (empty($this->field)) {
            $this->setError('Email is empty');
            return false;
        }

        if (!filter_var($this->field, FILTER_VALIDATE_EMAIL)) {
            $this->setError('Email is invalid');
            return false;
        }

        $host = explode('@', $this->field)[1];
        if (!checkdnsrr($host, 'MX')) {
            $this->setError('Mx record is not exists for domain ' . $host);
        }

        return true;
    }
}