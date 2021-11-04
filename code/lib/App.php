<?php

namespace App;

use App\Client\Client;
use App\Server\Server;

class App
{
    public function run()
    {
        set_time_limit(0);
        ob_implicit_flush();
        if ($_SERVER['argv'][1] === 'server') {
            $server = new Server();
            $server->run();
        } elseif ($_SERVER['argv'][1] === 'client') {
            $client = new Client();
            $client->run();
        }
     }
}