<?php

namespace Ivanboriev\TrustedBrackets\Validator\Rules;

class RequiredRule extends Rule
{
    /**
     * @return bool
     */
    public function apply(): bool
    {
        return isset($this->payload[$this->key]);
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return sprintf("The ['%s'] field is required!", $this->key);
    }
}