<?php

namespace App\Service;

class Validator
{
    /**
     * @param string $str
     *
     * @throws ValidatorException
     */
    public static function validate(string $str): void
    {
        if (empty($str)) {
            throw new ValidatorException(ValidatorException::EMPTY);
        }

        $bracketCounter = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            if ($str[$i] === '(') {
                $bracketCounter++;
            } elseif ($str[$i] === ')') {
                if ($bracketCounter < 1) {
                    throw new ValidatorException(ValidatorException::INCORRECT);
                }
                $bracketCounter--;
            }
        }

        if ($bracketCounter > 0) {
            throw new ValidatorException(ValidatorException::INCORRECT);
        }

        echo 'String validation completed successfully!' . PHP_EOL;
    }
}
