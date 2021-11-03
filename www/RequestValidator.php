<?php


class RequestValidator
{
    private $string;
    private $message;

    public function __construct()
    {
        $this->string = $_POST['string'] ?? null;
    }

    public function validate()
    {

        if (empty($this->string) || !$this->correctBrackets()) {
            $this->message = 'Все плохо';
            $this->setHeaderWithCode(400);
        } else {
            $this->message = 'Все хорошо';
            $this->setHeaderWithCode(200);
        }
        return $this->message;
    }

    private function correctBrackets()
    {
        $isCoincidence = preg_match("&^([^()]*\((?:[^()]|(?1))*\)[^()]*)+$|^[^()]+?$&", $this->string);
        if (!$isCoincidence) {
            return false;
        }
        return true;
    }

    private function setHeaderWithCode($code)
    {
        header('Content-Type: text/html; charset=utf-8', false, $code);
    }
}