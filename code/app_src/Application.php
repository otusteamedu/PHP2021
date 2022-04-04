<?php

namespace App;

class Application
{
    private $stringToCheck;
    private $openBracket = '(';
    private $closeBracket = ')';

    public function __construct()
    {
        if (!RequestValidator::checkRequestType('POST')) {
            throw new \Exception('ERROR_REQUEST_METHOD');
        }

        if (RequestValidator::checkRequestIsEmpty($_POST)) {
            throw new \Exception('EMPTY_REQUEST');
        }

        if (!empty($_POST['STRING_TO_CHECK'])) {
            $this->stringToCheck = $_POST['STRING_TO_CHECK'];
        } else {
            throw new \Exception('EMPTY_INPUT');
        }
    }

    public function run()
    {
        if (strpos($this->stringToCheck, $this->openBracket) === false &&
            strpos($this->stringToCheck, $this->closeBracket) === false) {
            throw new \Exception('BRACKETS_MISSING');
        }
        $this->checkBracketPairs();
    }

    private function checkBracketPairs()
    {
        $arChars = str_split($this->stringToCheck);
        $openBracketsCounter = 0;

        foreach ($arChars as $singleChar) {
            if ($singleChar == $this->closeBracket) {

                if ($openBracketsCounter <= 0) {
                    throw new \Exception('WITHOUT_PAIR_BRACKETS');
                }

                $openBracketsCounter--;
            }

            if ($singleChar == $this->openBracket) {
                $openBracketsCounter++;
            }
        }

        if ($openBracketsCounter) {
            throw new \Exception('WITHOUT_PAIR_BRACKETS');
        }
        throw new \Exception('BRACKETS_PAIR_OK');
    }
}
