<?php

namespace Src\Validators;

use Src\Request\Request;

class RequestValidator
{
    private $storage;

    public function __construct(Request $request, $method)
    {
        $this->storage = $request->$method;
    }


    public function validateBrackets()
    {
        foreach ($this->storage as $item) {
            if (empty($item) || !$this->correctBrackets($item)) {
                $this->setHeaderWithCode(400);
                return 'Все плохо';
            } else {
                $this->setHeaderWithCode(200);
            }

        }
        return 'Все хорошо';
    }

    private function correctBrackets($item)
    {
        $isCoincidence = preg_match("&^([^()]*\((?:[^()]|(?1))*\)[^()]*)+$|^[^()]+?$&", $item);
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