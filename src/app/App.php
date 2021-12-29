<?php

namespace App;

use Services\CheckBrackets;
use Services\Client;
use Services\Server;


class App
{
    public function run($argv)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['string'])) {
            $checkString = $_POST['string'];
            $result = new CheckBrackets($checkString);
            $result->check();
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