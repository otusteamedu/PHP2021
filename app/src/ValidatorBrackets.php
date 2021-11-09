<?php

namespace Src;

use Exception;

class ValidatorBrackets
{
    private string $brackets;

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
        $this->checkChars();
        $this->checkCorrect();

        echo 'Bracket correct';

    }

    /**
     * @throws Exception
     */
    private function checkCorrect(): void
    {
        $stack = [];
        for ($i = 0; $i < strlen($this->brackets); $i++) {
            if ($this->brackets[$i] == '(') {
                array_push($stack, $this->brackets[$i]);
            } elseif (empty($stack) || array_pop($stack) != '(') {
                throw new Exception('Brackets are not correct');
            }
        }

        if (!empty($stack)) {
            throw new Exception('Brackets are not correct');
        }
    }

    /**
     * @throws Exception
     */
    private function checkChars(): void
    {
        if (preg_match('/^[()]+$/', $this->brackets) == false) {
            throw new Exception('String is wrong');
        }
    }
}
