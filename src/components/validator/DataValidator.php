<?php

namespace Project\components\validator;

class DataValidator
{
    public static function isCorrectString(string $string = ""): bool
    {
        return !empty($string) && self::checkBracket($string);
    }

    private static function checkBracket(string $string = "", bool $clear = true): bool
    {
        if ($clear) {
            $string = preg_replace("/[^()]|\s/", "", $string);
        }

        $newString = str_replace("()", "", $string);

        if ($newString == $string && !empty($newString))  {
            return false;
        }

        return empty($newString) || self::checkBracket($newString, false);
    }
}