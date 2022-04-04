<?php

namespace App;

use App\Check;

class Application
{
    private $request;

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
        if (strpos($this->request['STRING'], Check::$openBracket) === false ||
            strpos($this->request['STRING'], Check::$closeBracket ) === false) {
            throw new \Exception('No brackets passed in string');
        }
        Check::checkBracketPairs($this->request['STRING']);
    }
}