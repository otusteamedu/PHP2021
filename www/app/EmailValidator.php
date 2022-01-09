<?php

namespace App;

class EmailValidator
{
    private $string;

    /**
     * @param $string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }

    public function verify()
    {
        if ($this->isValidEmail() && $this->isMXRecordCorrespondingToGivenHost()) {
            return true;
        }

        return false;
    }

    public function isValidEmail(): bool
    {
        return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",
            $this->string) ? true : false;
    }

    public function isMXRecordCorrespondingToGivenHost(): bool
    {
        if (filter_var($this->string, FILTER_VALIDATE_EMAIL)) {
            $parts_with_domain = explode('@', $this->string);

            return getmxrr($parts_with_domain[1], $mx_details);
        }

        return false;
    }

}