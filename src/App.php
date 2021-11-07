<?php

namespace App;

use App\Client\Client;
use App\Server\Server;
use Exception;

class App
{
    private const SERVER = 'server';
    private const CLIENT = 'client';

    private ?string $type = null;

    /**
     * App constructor.
     *
     * @param string|null $type
     *
     * @throws Exception
     */
    public function __construct(?string $type)
    {
        if ($type !== self::SERVER && $type != self::CLIENT) {
            throw new Exception('unknown application type');
        }

        $this->type = $type;
    }

    public function run(): void
    {
        set_time_limit(0);
        ob_implicit_flush();

        if ($this->type === self::SERVER) {
            $server = new Server();
            $server->run();
        }

        if ($this->type === self::CLIENT) {
            $client = new Client();
            $client->run();
        }
    }
}
