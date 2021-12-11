<?php

namespace Yu2ry\Support\Validations;

use SplObjectStorage;
use Yu2ry\Support\Validations\Rules\RuleContract;

/**
 * Class Validate
 * @package Yu2ry\Support\Validations
 */
class Validator
{

    /**
     * @var SplObjectStorage $rules
     */
    protected $rules;

    /**
     * @var array $message
     */
    protected $messages;

    /**
     * Validator constructor.
     */
    public function __construct()
    {
        $this->rules = new SplObjectStorage();
    }

    /**
     * @param RuleContract $rule
     * @return void
     */
    public function addRule(RuleContract $rule): void
    {
        $this->rules->attach($rule);
    }

    /**
     * @param RuleContract $rule
     * @return void
     */
    public function removeRule(RuleContract $rule): void
    {
        $this->rules->detach($rule);
    }

    /**
     * @param bool $bail search first error and stop
     * @return bool
     */
    public function passes(bool $bail = false): bool
    {
        $this->messages = [];

        /** @var RuleContract $rule */
        foreach ($this->rules as $rule) {
            $check = $rule->check();

            if (!$check) {
                $this->messages[] = $rule->message();
            }

            if ($bail && $check) {
                return false;
            }
        }
        return !count($this->messages);
    }

    /**
     * @return string|null
     */
    public function getLastMessageError():? string
    {
        return $this->messages[0] ?? null;
    }

    /**
     * @return array
     */
    public function getErrorMessages(): array
    {
        return $this->messages;
    }

    /**
     * @param string $separator
     * @return string|null
     */
    public function getErrorMessageText(string $separator = "\n"):? string
    {
        return !count($this->messages) ? null : implode($separator, $this->messages);
    }
}