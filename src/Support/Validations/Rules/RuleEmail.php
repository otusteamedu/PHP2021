<?php

namespace Yu2ry\Support\Validations\Rules;

/**
 * Class StringRule
 * @package Yu2ry\Support\Validations\Rules
 */
class RuleEmail extends AbstractRule
{

    /**
     * @return bool
     */
    public function check(): bool
    {
        if (!preg_match(
                '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',
                $this->data->getValue()
            ) || !getmxrr(explode('@', $this->data->getValue())[1], $hosts)) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return sprintf('Invalid %s email', $this->data->getValue());
    }
}