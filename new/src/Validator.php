<?php

namespace Src;

class Validator
{
    protected const OPEN_BRACKET = '(';
    protected const CLOSE_BRACKET = ')';

    /**
     * @param $string
     * @return bool
     */
    public static function String($string): bool
    {
        if (!empty($string)) {
            if (strpos($string, self::CLOSE_BRACKET) > strpos($string, self::OPEN_BRACKET)) {
                if (strrpos($string, self::OPEN_BRACKET) < strrpos($string, self::CLOSE_BRACKET)) {
                    $countBrackets = array_count_values(str_split($string));
                    if ($countBrackets[self::OPEN_BRACKET] === $countBrackets[self::CLOSE_BRACKET]) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}