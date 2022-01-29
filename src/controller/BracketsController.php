<?php

namespace Src\controller;

use Src\service\CheckBracketsInterface;
use Src\service\ResponseInterface;

class BracketsController
{
    private $bracketsCheck;
    private $response;

    public function __construct(CheckBracketsInterface $bracketsCheck, ResponseInterface $response)
    {
        $this->bracketsCheck = $bracketsCheck;
        $this->response = $response;
    }

    public function check($checkString)
    {
        $this->bracketsCheck->setString($checkString);

        $result = $this->bracketsCheck->check();
        if ($result) {
            $this->response->OkResponse('String OK');
        } else {
            $this->response->BadResponse('String Bad');
        }
    }


}