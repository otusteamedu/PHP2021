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
            throw new \Exception('Ошибочный метод запроса');
        }

        if (RequestValidator::checkRequestIsEmpty($_POST)) {
            throw new \Exception('Пустой запрос');
        }
        $this->request = $_POST;
    }

    public function run()
    {
        if (!isset($this->request['STRING_TO_CHECK']) || empty($this->request['STRING_TO_CHECK'])) {
            throw new \Exception('Ничего не введено');
        }

        if (strpos($this->request['STRING_TO_CHECK'], $this->openBracket) === false &&
            strpos($this->request['STRING_TO_CHECK'], $this->closeBracket) === false) {
            throw new \Exception('В введённом тексте отсутсвуют скобки');
        }
        $this->checkBracketPairs();
    }

    private function checkBracketPairs()
    {
        $arChars = str_split($this->request['STRING_TO_CHECK']);
        $openBracketsCounter = 0;

        foreach ($arChars as $singleChar) {
            if ($singleChar == $this->closeBracket) {

                if ($openBracketsCounter <= 0) {
                    throw new \Exception('У одной из скобок в тексте отсутствует пара :(');
                }
                $openBracketsCounter--;
            }

            if ($singleChar == $this->openBracket) {
                $openBracketsCounter++;
            }
        }

        if ($openBracketsCounter) {
            throw new \Exception('У одной из скобок в тексте отсутствует пара :(');
        }
        throw new \Exception('Со скобками в тексте всё хорошо :)');
    }
}
