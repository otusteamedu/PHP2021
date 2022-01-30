<?php

namespace App;

use Src\service\ResponseInterface;

class Route
{
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function route($container)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['string'])) {

            $container->call(['Src\controller\BracketsController', 'check'], ['checkString' => $_POST['string']]);

        } else {
            $this->response->NotFoundResponse();
        }
    }
}