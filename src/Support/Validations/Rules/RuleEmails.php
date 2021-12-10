<?php

namespace Yu2ry\Support\Validations\Rules;

/**
 * Class RuleEmails
 * @package Yu2ry\Support\Validations\Rules
 */
class RuleEmails extends AbstractRule
{

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @return bool
     */
    public function check(): bool
    {
        if (!is_array($this->data->getValue()) || count($this->data->getValue()) === 0) {
            return false;
        }

        foreach ($this->data->getValue() as $value) {
            if (!RuleEmail::factory(
                new RuleData($value, $this->data->getAttr())
            )->check()) {
                $this->errors[] = $value;
            }
        }

        return !count($this->errors);
    }

    /**
     * @return void
     */
    public function clearError(): void
    {
        $this->errors = [];
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return sprintf('Invalid %s emails', implode(', ', $this->errors));
    }
}