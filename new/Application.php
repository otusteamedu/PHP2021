<?php

namespace App;

use App\Check;

class Application
{
    
    public function __construct()
    {
        if (!RequestValidator::checkRequestType('POST')) {
            throw new \Exception('Wrong request method');
        }
        if (RequestValidator::checkRequestIsEmpty($_POST)) {
            throw new \Exception('Empty request');
        }
    }

    public function run()
    {
        if (!isset($_POST['STRING']) || empty($_POST['STRING'])) {
            throw new \Exception('No string passed');
        }
        if (strpos($_POST['STRING'], Check::$openBracket) === false ||
            strpos($_POST['STRING'], Check::$closeBracket ) === false) {
            throw new \Exception('No brackets passed in string');
        }
        Check::checkBracketPairs($_POST['STRING']);
    }
}