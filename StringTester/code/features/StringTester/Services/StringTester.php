<?php


namespace App\StringTester\Services;


class StringTester
{
    public static function testString(string $input): bool
    {
        $i = 0;
        $openCounter = 0;
        while ($i < strlen($input)) {
            if ($input[$i] === ")") {
                $openCounter--;
            } elseif ($input[$i] === "(") {
                $openCounter++;
            }
            if ($openCounter < 0) {
                return false;
            }
            $i++;
        }
        return $openCounter === 0;
    }
}