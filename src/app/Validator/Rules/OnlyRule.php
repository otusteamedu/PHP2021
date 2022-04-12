<?php

namespace Ivanboriev\TrustedBrackets\Validator\Rules;

class OnlyRule extends Rule
{

    private array $chars;

    /**
     * @param array $chars
     */
    public function __construct(array $chars)
    {
        $this->chars = $chars;
    }

    /**
     * @return bool
     */
    public function apply(): bool
    {
        foreach (str_split($this->payload[$this->key]) as $char) {
            if (!in_array($char, $this->chars)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return sprintf("The ['%s'] with only '%s' chars needed!", $this->key, implode(', ', $this->chars));
    }
}