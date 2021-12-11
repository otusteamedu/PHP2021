<?php

namespace Yu2ry\Support\Validations\Rules;

/**
 * Class ParenthesesRule
 * @package Yu2ry\Support\Validations\Rules
 */
class ParenthesesRule extends AbstractRule
{

    /**
     * @return bool
     */
    public function check(): bool
    {
        if (is_null($this->data->getValue())) {
            return false;
        }

        $arr = [];

        foreach (str_split($this->data->getValue()) as $key => $item) {
            if ($item === '(') {
                $arr[] = $key;
                continue;
            }
            if ($item === ')' && is_null(array_pop($arr))) {
                return false;
            }
        }

        return count($arr) === 0;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return 'Invalid string';
    }
}