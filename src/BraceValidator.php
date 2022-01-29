<?php

namespace App;

class BraceValidator
{
    public const
        OPEN_BRACE = '(',
        CLOSE_BRACE = ')';

    /**
     * @param string $str
     * @return bool
     */
    public static function isValid(string $str): bool
    {
        $stack = [];
        $len   = mb_strlen($str);
        for ($i = 0; $i < $len; $i++) {
            if ($str[$i] === self::OPEN_BRACE) {
                $stack[] = $str[$i];
                continue;
            }

            if ($str[$i] === self::CLOSE_BRACE && array_pop($stack) !== null) {
                continue;
            }

            return false;
        }

        return count($stack) === 0;
    }
}
