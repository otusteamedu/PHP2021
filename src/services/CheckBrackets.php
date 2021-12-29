<?php

namespace Services;

class CheckBrackets
{
    private $string;

    public function __construct(string $string)
    {
        $this->setString($string);
    }

    /**
     * @param string $string
     */
    public function setString(string $string): void
    {
        $this->string = $string;
    }

    /**
     * @return string
     */
    public function getString(): string
    {
        return $this->string;
    }

    private function checkPair($string)
    {
        $newString = str_replace("()", "", $string);
        if ($newString == $string && !empty($newString)) {
            return false;
        }
        return empty($newString) || self::checkPair($newString);
    }

    public function check()
    {
        if (empty($this->string)) {
            $result = false;
        } else {
            //Убираем все лишние символы
            $patern = '/[^()]|\s/';
            $string = preg_replace($patern, '', $this->getString());
            //Проверяем парность скобок
            $result = $this->checkPair($string);
        }
        if ($result) {
            http_response_code(200);
            echo 'String OK';
        } else {
            http_response_code(400);
            echo 'String Bad';
        }
    }
}