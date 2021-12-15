<?php

namespace App\Server;

use App\BasicSocket;
use App\Contractor\SocketContractor;

class Server extends BasicSocket implements SocketContractor
{
    /**
     * Run server
     */
    public function run()
    {
        try {
            echo "Socket init...".PHP_EOL;
            $this->initializeSocket();
            echo "Socket initialized".PHP_EOL;

            echo "Connection init...".PHP_EOL;
            $this->initializeConnection();

            echo "Waiting for a message...".PHP_EOL;
            $this->acceptMessages();
            
        } catch (\Exception $e) {
            echo $e->getMessage().PHP_EOL;
        } finally {
            $this->closeConnectionAndSocket();
        }
    }

    /**
     * Socket initialization
     *
     * @throws \Exception
     */
    public function initializeSocket(): void
    {
        if ( ! ($this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0))) {
            $this->throwExceptionWith("Couldn't create socket");
        }

        if (socket_bind($this->socket, $this->config->get('socket_path')) === false) {
            $this->throwExceptionWith("Couldn't bind socket");
        }

        if ( ! socket_listen($this->socket)) {
            $this->throwExceptionWith("Couldn't listen on socket");
        }
    }

    /**
     * Connection initialization
     *
     * @throws \Exception
     */
    private function initializeConnection(): void
    {
        $this->connection = socket_accept($this->socket);
        if ( ! $this->connection) {
            $this->throwExceptionWith("Couldn't initialize the connection");
        }

        if (socket_getpeername($this->connection, $address)) {
            echo "New connection $address initialized.".PHP_EOL;
        }
    }

    /**
     * Receives messages until stop word. 
     */
    private function acceptMessages()
    {
        do {
            $message = socket_read($this->connection, 1024);
            
            if ($message === false) {
                $this->throwExceptionWith("Can not receive a message");
            }

            echo $message.PHP_EOL;
            
            $back_message = 'Received "' . (strlen($message)>15 ? substr($message, 0, 15).'...' : $message) . '"';
            if (socket_write($this->connection, $back_message, strlen($back_message) ) === false
            ) {
                $this->throwExceptionWith("Can not send a message");
            }
            
        } while ($message !== $this->config->get('stop_word'));
    }
    
}