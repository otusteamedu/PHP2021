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
            throw new \Exception('<span style="color: red">Ошибочный метод запроса</span>');
        }

        if (RequestValidator::checkRequestIsEmpty($_POST)) {
            throw new \Exception('<span style="color: red">Пустой запрос</span>');
        }
        $this->request = $_POST;
    }

    public function run()
    {
        if (!isset($this->request['STRING_TO_CHECK']) || empty($this->request['STRING_TO_CHECK'])) {
            throw new \Exception('<span style="color: red">Ничего не введено</span>');
        }

        if (strpos($this->request['STRING_TO_CHECK'], $this->openBracket) === false &&
            strpos($this->request['STRING_TO_CHECK'], $this->closeBracket) === false) {
            throw new \Exception('<span style="color: red">В введённом тексте отсутсвуют скобки</span>');
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
                    throw new \Exception('<span style="color: red">У одной из скобок в тексте отсутствует пара :(</span>');
                }
                $openBracketsCounter--;
            }

            if ($singleChar == $this->openBracket) {
                $openBracketsCounter++;
            }
        }

        if ($openBracketsCounter) {
            throw new \Exception('<span style="color: red">У одной из скобок в тексте отсутствует пара :(</span>');
        }
        throw new \Exception('<span style="color: green">Со скобками в тексте всё хорошо :)</span>');
    }
}
