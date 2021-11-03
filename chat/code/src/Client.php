<?php

namespace Chat;

use Chat\AppSocket;
use Chat\Contracts\App;

class Client implements App
{
    public function __construct(
        private AppSocket $socket,
        private Config $config,
        private Console $console
    )
    { }

    public function start(): void
    {
        $this->socket->connect($this->config->get('socket'));

        while (true) {
            $this->socket->write($this->console->read());
            $this->console->write('Server: ' . $this->socket->read() . PHP_EOL);
        }

    }
}
