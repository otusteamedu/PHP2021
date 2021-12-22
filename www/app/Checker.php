<?php


namespace App;


class Checker
{
    CONST OPEN_BRACKET = '(';
    CONST CLOSE_BRACKET = ')';
    
    private string $string;

    /**
     * Checker constructor.
     *
     * @param  string  $string
     */
    public function __construct(string $string)
    {
        $this->string = $string;
    }

    public function run()
    {
        $opened_brackets = 0;
        $closed_brackets = 0;
        
        $array_chars = str_split($this->string);
        
        foreach ($array_chars as $index => $char){
            if ($index === array_key_first($array_chars) && $char == static::CLOSE_BRACKET){
                throw new \Exception('A string can not start from a closing bracket');
            }

            if ($index === array_key_last($array_chars) && $char == static::OPEN_BRACKET){
                throw new \Exception('A string can not finish with a opening bracket');
            }
            
             if ($char == static::OPEN_BRACKET){
                 $opened_brackets++;
             }

            if ($char == static::CLOSE_BRACKET){
                $closed_brackets++;
            }
        }

        if($opened_brackets == 0 && $closed_brackets == 0){
            throw new \Exception('No brackets found');
        }
        
        if ($opened_brackets !== $closed_brackets){
            throw new \Exception('Seems like there is a missed bracket');
        }
    }
    
}