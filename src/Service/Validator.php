<?php

namespace App\Service;

class Validator
{
    public static function validate(string $str): bool
    {
        $bracketCounter = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            if ($str[$i] === '(') {
                $bracketCounter++;
            } elseif ($str[$i] === ')') {
                if ($bracketCounter < 1) {
                    return false;
                }
                $bracketCounter--;
            }
        }

        if ($bracketCounter > 0) {
            return false;
        }

        return true;
    }
}
