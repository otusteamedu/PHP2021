<?php 

namespace App;

class Application
{
    private $request;
    private $openBracket = '(';
    private $closeBracket = ')';

    public static function validateRequest()
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            throw new \Exception('Wrong request method');
        }
    }

    public function __construct()
    {
        $this->request = $_POST;
        if ($this->checkRequestIsEmpty) {
            throw new \Exception('No arguments passed');
        }
    }

    private function checkRequestIsEmpty()
    {
        return empty($this->request) ? true : false;
    }

    public function checkString()
    {
        if (!isset($this->request['STRING_TO_CHECK']) || empty($this->request['STRING_TO_CHECK'])) {
            throw new \Exception('No string passed');
        }
        if (strpos($this->request['STRING_TO_CHECK'], $this->openBracket) === false ||
            strpos($this->request['STRING_TO_CHECK'], $this->closeBracket) === false) {
            throw new \Exception('No brackets passed in string');
        }
        $this->checkBracketPairs();
    }

    private function checkBracketPairs()
    {
        $arChars = str_split($this->request['STRING_TO_CHECK']);
        $openBracketsCounter = 0;
        foreach($arChars AS $singleChar) {
            if ($singleChar == $this->closeBracket) {
                if($openBracketsCounter <= 0) {
                    throw new \Exception('Brackets not paired');
                }
                $openBracketsCounter--;
            }
            if ($singleChar == $this->openBracket) {
                $openBracketsCounter++;
            }
        }
        if ($openBracketsCounter) {
            throw new \Exception('Brackets not paired');
        }
        header('HTTP/1.0 200 Ok');
        echo 'Everything is fine'.PHP_EOL;
    }
}
