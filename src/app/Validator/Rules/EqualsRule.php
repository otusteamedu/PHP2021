<?php

namespace Ivanboriev\TrustedBrackets\Validator\Rules;

class EqualsRule extends Rule
{

    private string $char1;

    private string $char2;

    /**
     * @param string $char1
     * @param string $char2
     */
    public function __construct(string $char1, string $char2)
    {
        $this->char1 = $char1;
        $this->char2 = $char2;
    }

    /**
     * @return bool
     */
    public function apply(): bool
    {
        return $this->counter($this->char1, $this->payload[$this->key]) === $this->counter($this->char2, $this->payload[$this->key]);
    }

    /**
     * @param string $needle
     * @param string $haystack
     * @return int
     */
    private function counter(string $needle, string $haystack): int
    {
        return array_reduce(str_split($haystack), function ($carry, $char) use ($needle) {
            return $char === $needle ? $carry + 1 : $carry;
        }, 0);
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return sprintf("The count '%s' not equals count '%s' chars!", $this->char1, $this->char2);
    }
}