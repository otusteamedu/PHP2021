<?php

namespace Controllers;

class Validate
{
    public static function isValidate($request) : bool {

        $valueArr = str_split($request);

        $count = 0;

        foreach ($valueArr as $item) {

            if ($item == '(') {
                $count++;
            } elseif ($item == ')') {
                $count--;
            } else {
                throw new \Exception('Неверный символ');
            }

        }

        if ($count == 0) {
            return true;
        } else {
            return false;
        }

    }
}