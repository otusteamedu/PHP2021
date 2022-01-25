<?php

namespace App;

use Services\Client;
use Services\Server;


class App
{
    private $bracketsController;

    public function __construct(BracketsControllerInterface $bracketsController)
    {
        $this->bracketsController = $bracketsController;
    }


    public function run($argv)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['string'])) {

            $checkString = $_GET['string'];
            $this->bracketsController->check($checkString);

        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['string'])) {

            $checkString = $_GET['string'];
            $this->bracketsController->check($checkString);

        }

        if (PHP_SAPI === 'cli') {
            $service = $argv[1] ?? '';
            if ($service === 'server') {
                $server = new Server();
                $server->run();
            } elseif ($service === 'client') {
                $client = new Client();
                $client->run();
            }

        }
    }
}