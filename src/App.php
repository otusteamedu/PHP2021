<?php

declare(strict_types=1);

namespace App;

use App\Server\Server;
use App\Client\Client;

class App
{
    public function run($mode): void
    {
        set_time_limit(0);
        ob_implicit_flush();

        if($mode == 'server') {
            $server = new Server();
            $server->runServer();
        }
        else if($mode == 'client') {
            $server = new Client();
            $server->runClient();
        }
    }
}