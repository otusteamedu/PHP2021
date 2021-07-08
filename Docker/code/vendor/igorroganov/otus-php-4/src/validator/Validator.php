<?php
namespace App\validator;

class Validator
{
    public function IsValidBrackets($brackets):bool {

        $counter = 0;
        $bracket_str = mb_str_split($brackets);// (()()(()))

        foreach ( $bracket_str as $char ) {

            if ( $char == "(" ) {
                $counter++;
            }
            elseif ( $char == ")" ) {
                $counter--;
            }else{

                throw new \Exception('Передан неверный символ');
            }
        }

        return $counter === 0;
    }
}
