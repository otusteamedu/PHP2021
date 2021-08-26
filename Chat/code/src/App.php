<?php

namespace App;

use Chat\Server;
use Chat\Client;

class App
{
    public function run()
    {
        $argv1 = $_SERVER['argv'][1];

        if($argv1 == 'server') {
            $server = new Server();
        } elseif ($argv1 == 'client') {
            $client = new Client();
        } else {
            throw new \Exception('Укажите аргумент: server, client' . PHP_EOL);
        }
    }
}