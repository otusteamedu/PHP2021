<?php

namespace Validator;

class Validator 
{
    public static function check(string $string): bool
    {
        $counter = 0;
        $length = strlen($string);
        
        for ($i = 0; $i < $length; $i++) {
            $char = $string[$i];
            if ($char == '(') {
                $counter++;
            } else if ($char == ')') {
                $counter--;
            }

            if ($counter < 0) {
                return false;
            }
        }
        return $counter == 0;
    }
}
