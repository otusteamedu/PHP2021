<?php

namespace App\Socket;

final class Client
{

    private Socket $socket;

    public function __construct(string $file)
    {
        $this->initSocket($file);
    }

    public function waitForMessage()
    {
        echo "Enter Message:\t";
        $this->message($this->readline());
    }

    private function message(string $message)
    {
        $this->socket->write($message);
        $this->waitingResponse();
    }

    private function initSocket(string $file): void
    {
        $this->socket = new Socket($file);
        $this->socket->create();
        $this->socket->connect();
    }

    private function readline(): string
    {
        return rtrim(fgets(STDIN));
    }

    private function waitingResponse()
    {
        echo "Server Reply:\t" . $this->socket->read() . PHP_EOL;
    }
}
