<?php

namespace App;

class Application
{
    private $request;
    private $openBracket = '(';
    private $closeBracket = ')';

    public function __construct()
    {
        if (!RequestValidator::checkRequestType('POST')) {
            throw new \Exception('Wrong request method');
        }
        if (RequestValidator::checkRequestIsEmpty($_POST)) {
            throw new \Exception('Empty request');
        }
        $this->request = $_POST;
    }

    public function run()
    {
        if (!isset($this->request['STRING']) || empty($this->request['STRING'])) {
            throw new \Exception('No string passed');
        }
        if (strpos($this->request['STRING'], $this->openBracket) === false ||
            strpos($this->request['STRING'], $this->closeBracket) === false) {
            throw new \Exception('No brackets passed in string');
        }
        $this->checkBracketPairs();
    }

    private function checkBracketPairs()
    {
        $arChars = str_split($this->request['STRING']);
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
        throw new \Exception('Everything is fine');
    }
}