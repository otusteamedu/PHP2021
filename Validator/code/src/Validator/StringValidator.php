<?php

namespace Validator;

class StringValidator
{
    private string $string;

    private string $error;

    function __construct(string $string)
    {
        $this->string = trim($string);
    }

    public function validate()
    {
        try {
            $this->checkEmpty();
            $this->checkBrackets();
        } catch (\Exception $e) {
            $this->error = $e->getMessage();

            return false;
        }

        return true;
    }

    public function getError()
    {
        return $this->error;
    }

    private function checkEmpty()
    {
        if (!$this->string) {
            throw new \Exception('Переданая строка пустая!');
        }
    }

    private function checkBrackets()
    {
        $regexBrackets = "^[^()]*+(\((?>[^()]|(?1))*+\)[^()]*+)++$";
        $checkBrackets = (preg_match("/^$regexBrackets\$/", $this->string));
        
        if ($checkBrackets == 0) {
            $openBracketsCount = substr_count($this->string, '(');    
            $closeBracketsCount = substr_count($this->string, ')');
            if ($openBracketsCount > $closeBracketsCount) {
                $difference = $openBracketsCount - $closeBracketsCount;
                throw new \Exception('Отсутствуют закрывающие скобки: ' . $difference);
            }elseif ($openBracketsCount < $closeBracketsCount) {
                $difference = $closeBracketsCount - $openBracketsCount;
                throw new \Exception('Отсутствуют открывающие скобки: ' . $difference);
            } else {
                throw new \Exception('Отсутствуют открывающие: ' . $openBracketsCount . ' и закрывающие: ' . $closeBracketsCount . ' скобки!');
            }
        }
    }
}