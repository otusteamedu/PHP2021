<?php

namespace App;

use Chat\Server;
use Chat\Client;

class App
{
    public function run()
    {
        $role = $_SERVER['argv'][1];

        if($role == 'server') {
            $server = new Server();
        } elseif ($role == 'client') {
            $client = new Client();
        } else {
            throw new \Exception('Укажите аргумент: server, client' . PHP_EOL);
        }
    }
}