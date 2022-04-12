<?php

namespace Ivanboriev\TrustedBrackets\Validator\Rules;

abstract class Rule
{
    protected array $payload;

    protected string $key;

    abstract public function apply(): bool;


    /**
     * @param string $key
     * @param array $payload
     * @return void
     */
    public function configure(string $key, array $payload = []): void
    {
        $this->key = $key;

        foreach ($payload as $k => $v) {
           $this->payload[$k] = trim($v);
        }
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return "Default error message";
    }

}