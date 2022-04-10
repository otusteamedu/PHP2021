<?php

namespace Ivanboriev\TrustedBrackets\Validator;

class Validator
{
    public static function required($string, $params = [])
    {
        return array_key_exists($string, $params);
    }

    public static function isEmpty($param)
    {
        return empty($param);
    }

    public static function onlyChars($needle, $haystack)
    {
        foreach (str_split($haystack) as $char) {
            if (!in_array($char, $needle)) {
                return false;
            }
        }

        return true;
    }

    public static function equals($char1, $char2, $haystack)
    {
        function counter($needle, $haystack)
        {
            return array_reduce(str_split($haystack), function ($carry, $char) use ($needle) {
                return $char === $needle ? $carry + 1 : $carry;
            }, 0);

        }

        return counter($char1, $haystack) === counter($char2, $haystack);
    }
}