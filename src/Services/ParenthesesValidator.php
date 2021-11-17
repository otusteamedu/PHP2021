<?php

declare(strict_types=1);

namespace Sources\Services;

class ParenthesesValidator
{
    private string $parentheses;

    public function __construct($input)
    {
        $this->parentheses = trim($input);
    }

    protected function validate(): bool
    {
        $stack = [];
        $len = strlen($this->parentheses);

        for ($i = 0; $i < $len; $i++) {
            switch ($this->parentheses[$i]) {
                case '(':
                    array_push($stack, 1);
                    break;
                case ')':
                    if (array_pop($stack) !== 1) {
                        return false;
                    }
                    break;
                default:
                    break;
            }
        }

        return empty($stack);
    }

    public function getValidation(): HttpResponse
    {
        if (empty($this->parentheses)) {
            $message = 'Input string is empty';
            $code = 400;
        } else {
            if ($this->validate()) {
                $message = 'Input string is valid';
                $code = 200;
            } else {
                $message = 'Input string is not valid';
                $code = 400;
            }
        }

        return new HttpResponse($code, $message);
    }
}