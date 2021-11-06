<?php

declare(strict_types=1);

namespace App;

use App\Server\Server;

class App
{
    public function run(): void
    {
        set_time_limit(0);
        ob_implicit_flush();

        $server = new Server();
        $server->runServer();
    }
}