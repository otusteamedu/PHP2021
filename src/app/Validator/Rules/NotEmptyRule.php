<?php

namespace Ivanboriev\TrustedBrackets\Validator\Rules;

class NotEmptyRule extends Rule
{
    /**
     * @return bool
     */
    public function apply(): bool
    {
        return !empty($this->payload[$this->key]);
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return sprintf("The ['%s'] field is empty!", $this->key);
    }
}