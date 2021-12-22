<?php

namespace App\Application\ValueObject;

class Email
{
    private $value;

    /**
     * @param  string  $value
     */
    public function __construct($value)
    {
        $this->assertValidEmail($value);
        $this->value = $value;
    }

    private function assertValidEmail($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Невалидный EMAIL");
        }
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}