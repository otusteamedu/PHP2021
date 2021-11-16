<?php

declare(strict_types=1);

namespace App;

use App\Server\Server;
use App\Client\Client;

class App
{
    public function run(): void
    {
        set_time_limit(0);
        ob_implicit_flush();

		if(isset($_SERVER['argv'][1]) && $_SERVER['argv'][1] == 'server'){
			$server = new Server();
			$server->runServer();
		}
		if(isset($_SERVER['argv'][1]) && $_SERVER['argv'][1] == 'client'){
			$client = new Client();
			$client->runClient();
		}
    }
}
