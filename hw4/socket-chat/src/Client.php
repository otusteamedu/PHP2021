<?php declare(strict_types=1);

namespace App;

use App\IO\InputInterface;
use App\IO\OutputInterface;
use App\IO\IOException;
use App\Socket\SocketException;
use App\Socket\SocketInterface;

class Client
{
    public function __construct(
        private SocketInterface $socket,
        private InputInterface $input,
        private OutputInterface $output,
    ) {
    }

    /**
     * @throws SocketException
     * @throws IOException
     */
    public function run(string $addr)
    {
        $this->socket->connect($addr);
        $this->output->write('Server connection established' . PHP_EOL);

        while (true) {
            $clientMsg = $this->input->read();
            $this->socket->write($clientMsg);

            $serverMsg = $this->socket->read();
            $this->output->write($serverMsg);
        }
    }
}
