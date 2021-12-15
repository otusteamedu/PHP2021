<?php
namespace App\Client;

use App\BasicSocket;
use App\Contractor\SocketContractor;

class Client extends BasicSocket implements SocketContractor
{
    /**
     * Run client
     */
    public function run()
    {
        try {
            echo "Socket init...".PHP_EOL;
            $this->initializeSocket();
            echo "Connection established".PHP_EOL;
            
            echo 'Input text message: ' . PHP_EOL;
            
            $this->sendMessage();
            
        } catch (\Exception $e) {
            echo $e->getMessage().PHP_EOL;
        } finally {
            $this->closeConnectionAndSocket();
        }
    }

    protected function sendMessage(): void
    {
        do {
            $message_out = trim(fgets(STDIN));

            if (empty($message_out)){
                continue;
            }

            $write = socket_write($this->socket, $message_out, strlen($message_out));

            if ($write === false) {
                $this->throwExceptionWith('Can not send a message');
            }

            $message_srv = socket_read($this->socket, 1024);

            if ($message_srv === false) {
                $this->throwExceptionWith("Can not receive a message");
            }

            echo 'Server message: ' . $message_srv . PHP_EOL;

        } while ($message_out != $this->config->get('stop_word'));
    }

    /**
     * Инициализирует сокет.
     *
     * @throws \Exception
     */
    public function initializeSocket(): void
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        if(! $this->socket ) {
            $this->throwExceptionWith("Couldn't create socket");
        }

        if (!socket_connect($this->socket, $this->config->get('socket_path'))) {
            $this->throwExceptionWith("Couldn't connect to socket");
        }
    }
    
}