<?php
declare(strict_types=1);

namespace App;

class Check
{
    const MESSAGE = 'Everything is fine';
    static $openBracket = '(';
    static $closeBracket = ')';


    static function checkBracketPairs(string $request) : void
    {
        $arChars = str_split($request);
        $openBracketsCounter = 0;
        foreach($arChars AS $singleChar) {
            if($openBracketsCounter <= 0) throw new \Exception('Brackets not paired');

            if ($singleChar == self::$closeBracket) $openBracketsCounter--;
            else if ($singleChar == self::$openBracket) $openBracketsCounter++;
        }
        if ($openBracketsCounter) throw new \Exception('Brackets not paired');

        throw new \Exception(self::MESSAGE);
    }
}