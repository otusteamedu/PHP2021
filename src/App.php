<?php

namespace App;

use App\Service\Client;
use App\Service\Service;
use App\Service\Server;
use Exception;

class App
{
    private const SERVER = 'server';
    private const CLIENT = 'client';

    private Service $service;

    /**
     * App constructor.
     *
     * @param string|null $type
     *
     * @throws Exception
     */
    public function __construct(?string $type)
    {
        switch ($type) {
            case self::SERVER:
                $this->service = new Server();
                break;
            case self::CLIENT:
                $this->service = new Client();
                break;
            default:
                throw new Exception('unknown service type');
        }
    }

    public function run(): void
    {
        set_time_limit(0);
        ob_implicit_flush();

        $this->service->run();
    }
}
