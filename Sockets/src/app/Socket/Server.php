<?php

namespace App\Socket;

final class Server
{
    private Socket $socket;

    public function __construct(string $file)
    {
        $this->initSocket($file);
    }

    public function listen()
    {
        do {
            $this->socket->accept();

            $message = $this->socket->readFromAccepted();

            if ($message === 'quit') {
                echo "Server turned off\n";
                break;
            }
            echo "Client says:\t" . $message . "\n";
            echo "Enter Reply:\t";
            $reply = $this->readline();
            $this->socket->writeToAccepted($reply);
            echo "-------------------------\n";
        } while (true);

        $this->socket->close();
    }

    private function initSocket(string $file): void
    {
        $this->socket = new Socket($file);
        $this->socket->clearOldSocket();
        $this->socket->create();
        $this->socket->bind();
        $this->socket->listen();
        echo "Server started and listen\n";
    }

    private function readline(): string
    {
        return rtrim(fgets(STDIN));
    }
}
