<?php

namespace Controllers;

class Validate
{
//    public function __construct($value) {
//        $this->value = $value;
//    }

    public static function isValidate($value) : bool {

        $valueArr = str_split($value);

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