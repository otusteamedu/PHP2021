<?php

namespace App;

use Services\CheckBrackets;
use Services\CheckBracketsInterface;
use Services\Client;
use Services\Server;


class App
{
    public $checkBrackets;

    public function __construct(CheckBracketsInterface $checkBrackets)
    {
        $this->checkBrackets = $checkBrackets;
    }


    public function run($argv)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['string'])) {

            $checkString = $_POST['string'];
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