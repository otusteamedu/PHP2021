<?php

namespace Src;

class Validator
{
    /**
     * @param $string
     * @return bool
     */
    public static function String($string): bool
    {
        if (!empty($string)) {
            if (strpos($string, ')') > strpos($string, '(')) {
                if (strrpos($string, '(') < strrpos($string, ')')) {
                    $countBrackets = array_count_values(str_split($string));
                    if ($countBrackets['('] === $countBrackets[')']) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}