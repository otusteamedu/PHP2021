<?php

namespace App;

use Services\CheckBracketsInterface;

class BracketsController implements BracketsControllerInterface
{
    public $checkBrackets;

    public function __construct(CheckBracketsInterface $checkBrackets)
    {
        $this->checkBrackets = $checkBrackets;
    }

    public function check(string $checkString)
    {
        $this->checkBrackets->setString($checkString);
        $result = $this->checkBrackets->check();

        if ($result) {
            http_response_code(200);
            echo 'String OK';
        } else {
            http_response_code(400);
            echo 'String Bad';
        }
    }


}