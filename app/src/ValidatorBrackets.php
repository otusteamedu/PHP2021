<?php

namespace Src;

use Exception;

class ValidatorBrackets
{
    private string $brackets;

    private string $reason;

    /**
     * ValidatorBrackets constructor.
     *
     * @param string $brackets
     * @throws Exception
     */
    public function __construct(string $brackets)
    {
        $this->brackets = $brackets;
    }

    /**
     * @throws Exception
     */
    public function validate()
    {
        if (false === $this->isValidChars()) {
            $this->reason = 'String is wrong';
            return false;
        }

        if (false === $this->isValidBrackets()) {
            $this->reason = 'Brackets are not correct';
            return false;
        }

        return true;
    }

    private function isValidBrackets(): bool
    {
        $stack = [];
        for ($i = 0; $i < strlen($this->brackets); $i++) {
            if ($this->brackets[$i] == '(') {
                array_push($stack, $this->brackets[$i]);
            } elseif (empty($stack) || array_pop($stack) != '(') {
                return false;
            }
        }

        if (!empty($stack)) {
            return false;
        }

        return true;
    }

    private function isValidChars(): bool
    {
        return !!preg_match('/^[()]+$/', $this->brackets);
    }

    public function getReason(): string
    {
        return $this->reason;
    }
}
