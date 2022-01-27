<?php

namespace Src\controller;

use Src\service\CheckBracketsInterface;

class BracketsController
{
    private $bracketsCheck;


    public function __construct(CheckBracketsInterface $bracketsCheck)
    {
        $this->bracketsCheck = $bracketsCheck;
    }

    public function check($checkString)
    {

        $this->bracketsCheck->setString($checkString);

        $result = $this->bracketsCheck->check();
        if ($result) {
            http_response_code(200);
            echo 'String OK';
        } else {
            http_response_code(400);
            echo 'String Bad';
        }
    }


}