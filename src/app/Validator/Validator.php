<?php

namespace Ivanboriev\TrustedBrackets\Validator;

use Ivanboriev\TrustedBrackets\Validator\Rules\Rule;

class Validator
{
    private array $rules = [];

    private array $payload = [];

    private array $failedStackMessages = [];


    /**
     * @param array $payload
     * @param array $haystack
     * @return void
     */
    public function make(array $payload, array $haystack): void
    {
        foreach ($haystack as $key => $ruleStack) {

            $this->rules[] = [
                'key' => $key,
                'rules' => array_map(function (Rule $rule) use ($payload, $key) {
                    $rule->configure($key, $payload);
                    return $rule;
                }, $ruleStack)
            ];
        }


    }


    /**
     * @return bool
     */
    public function fails(): bool
    {
        foreach ($this->rules as $rules) {
            foreach ($rules['rules'] as $rule) {
                if (!$rule->apply()) {
                    $this->failedStackMessages[$rules['key']][] = $rule->message();
                    return true;
                }
            }
        }

        return false;
    }


    /**
     * @return string
     */
    public function error(): string
    {
        return !empty($this->failedStackMessages) ? current($this->failedStackMessages)[0] : "";
    }

}