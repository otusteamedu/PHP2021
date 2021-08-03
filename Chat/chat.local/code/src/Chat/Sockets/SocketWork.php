<?php


declare(strict_types=1);


namespace Chat\Sockets;


use Chat\Sockets\Templates\Socket;

final class SocketWork extends Socket
{

    public function clearSocketFile(): void
    {
        if (file_exists($this->host)) {
            unlink($this->host);
        }
    }

    public function readFromSocket(): ?string
    {
        return $this->read($this->socket);
    }

    public function readFromAcceptedSocket(): ?string
    {
        return $this->read($this->acceptedSocket);
    }

    public function writeToSocket(string $message): void
    {
        $this->write($this->socket, $message);
    }

    public function writeToAccepted(string $message): void
    {
        $this->write($this->acceptedSocket, $message);
    }

}
