<?php

namespace Src\service;


class CheckBrackets implements CheckBracketsInterface
{
    private $string;

    public function setString(string $string): void
    {
        $this->string = $string;
    }

    public function getString(): string
    {
        return $this->string;
    }

    private function checkPair($string): string
    {
        $newString = str_replace("()", "", $string);
        if ($newString == $string && !empty($newString)) {
            return false;
        }
        return empty($newString) || self::checkPair($newString);
    }

    public function check(): bool
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
        return $result;
    }
}