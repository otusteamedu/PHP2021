<?php

namespace App;

final class Server
{
    private $socket;

    public function __construct($host, $port)
    {
        $this->initSocket($host, $port);
    }

    public function listen()
    {
        do {
            $this->socket->accept();

            $message = $this->socket->readFromAccepted();

            if ($message === 'quit') {
                break;
            }
            echo "Client says:\t" . $message . "\n\n";

            echo "Enter Reply:\t";
            $reply = $this->readline();
            $this->socket->writeToAccepted($reply);
        } while (true);

        $this->socket->close();
    }

    private function initSocket($host, $port)
    {
        echo "Init socket";
        $this->socket = new Socket($host, $port);
        $this->socket->clearOldSocket();
        $this->socket->create();
        $this->socket->bind();
        $this->socket->listen();
    }

    private function readline()
    {
        return rtrim(fgets(STDIN));
    }

    public function run()
    {
        $this->listen();
    }
}