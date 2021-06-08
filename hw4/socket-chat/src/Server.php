<?php declare(strict_types=1);

namespace App;

use App\IO\InputInterface;
use App\IO\OutputInterface;
use App\IO\IOException;
use App\Socket\SocketException;
use App\Socket\SocketInterface;
use App\Socket\Socket;

class Server
{
    public function __construct(
        private SocketInterface $socket,
        private InputInterface $input,
        private OutputInterface $output
    ) {
    }

    /**
     * @throws SocketException
     * @throws IOException
     */
    public function run(string $addr)
    {
        $this->socket->bind($addr);
        $this->socket->listen();

        while (true) {
            $this->output->write('Waiting for a new connection...' . PHP_EOL);

            $clientSocket = $this->socket->accept();

            $this->output->write('Client connected' . PHP_EOL);

            while (true) {
                try {
                    $clientMsg = $clientSocket->read();
                    $this->output->write($clientMsg);

                    $serverMsg = $this->input->read();
                    $clientSocket->write($serverMsg);
                } catch (SocketException $e) {
                    if ($e->getCode() === SOCKET_ECONNRESET) {
                        break;
                    }

                    return;
                }
            }
        }
    }
}
