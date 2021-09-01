<?php

namespace Chat;

use Chat\Contracts\App;

class Client implements App
{
    private AppSocket $socket;
    private Config $config;
    private Console $console;

    public function __construct(AppSocket $socket, Config $config, Console $console)
    {
        $this->socket = $socket;
        $this->config = $config;
        $this->console = $console;

     }

    public function start(): void
    {
        $this->socket->connect($this->config->get('socket'));

        while (true) {
            $this->socket->write($this->console->read());
            $this->console->write('Server: ' . $this->socket->read() . PHP_EOL);
        }

    }
}