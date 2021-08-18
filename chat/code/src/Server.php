<?php

namespace Chat;

use Chat\Contracts\App;

class Server implements App
{
    public function __construct(
        private AppSocket $socket,
        private Config $config,
        private Console $console
    )
    { }

    public function start(): void
    {
        $this->initSocket();

        while (true) {
            $this->console->write('Server is working' . PHP_EOL);
            $socketAccepted = $this->socket->accept();
            $this->console->write('Client has been connected' . PHP_EOL);

            while (true) {
                $msg = $socketAccepted->read();
                $this->console->write('Client: ' . $msg . PHP_EOL);

                $msg = $this->console->read();
                $socketAccepted->write($msg);
            }
        }
    }

    private function initSocket()
    {
        $socket = $this->config->get('socket');

        unlink($socket);

        $this->socket->bind($socket);
        $this->socket->listen();
    }
}
