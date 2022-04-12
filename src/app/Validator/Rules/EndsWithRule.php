<?php

namespace Ivanboriev\TrustedBrackets\Validator\Rules;

class EndsWithRule extends Rule
{

    private string $needed;

    /**
     * @param string $needed
     */
    public function __construct(string $needed)
    {
        $this->needed = $needed;
    }

    /**
     * @return bool
     */
    public function apply(): bool
    {
        return strrpos($this->payload[$this->key],$this->needed) === strlen($this->payload[$this->key]) - 1;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return sprintf("The ['%s'] end with '%s' needed!", $this->key, $this->needed);
    }
}