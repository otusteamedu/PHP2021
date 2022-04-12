<?php

namespace Ivanboriev\TrustedBrackets\Validator\Rules;

class StartsWithRule extends Rule
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
        return stripos($this->payload[$this->key],$this->needed) === 0;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return sprintf("The ['%s'] start with '%s' needed!", $this->key, $this->needed);
    }
}