<?php

namespace App\Service;

use Exception;

class Validator
{
    /**
     * @param string $str
     *
     * @throws Exception
     */
    public static function validate(string $str): void
    {
        if (empty($str)) {
            throw new Exception('String not defined', 400);
        }

        $bracketCounter = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            if ($str[$i] === '(') {
                $bracketCounter++;
            } elseif ($str[$i] === ')') {
                if ($bracketCounter < 1) {
                    throw new Exception('Incorrect string', 400);
                }
                $bracketCounter--;
            }
        }

        if ($bracketCounter > 0) {
            throw new Exception('Incorrect string', 400);
        }

        echo 'String validation completed successfully!' . PHP_EOL;
    }
}
