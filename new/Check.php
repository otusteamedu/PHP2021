<?php

namespace App;

class Check
{
    static $openBracket = '(';
    static $closeBracket = ')';


    static function checkBracketPairs($request)
    {
        $arChars = str_split($request);
        $openBracketsCounter = 0;
        foreach($arChars AS $singleChar) {
            if ($singleChar == self::$closeBracket) {
                if($openBracketsCounter <= 0) {
                    throw new \Exception('Brackets not paired');
                }
                $openBracketsCounter--;
            }
            if ($singleChar == self::$openBracket) {
                $openBracketsCounter++;
            }
        }
        if ($openBracketsCounter) {
            throw new \Exception('Brackets not paired');
        }
        throw new \Exception('Everything is fine');
    }

}