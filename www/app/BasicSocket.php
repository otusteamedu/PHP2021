<?php


namespace App;

use App\Contractor\SocketContractor;

class BasicSocket
{
    /** @var false|resource|\Socket */
    protected $socket;

    /** @var false|resource|\Socket */
    protected $connection;
    
    /** @var Config */
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }
    
    /**
     * Closes connections and sockets.
     */
    public function closeConnectionAndSocket(): void
    {
        //close server side
        if ($this->connection) {
            socket_close($this->connection);

            if(file_exists($this->config->get('socket_path'))) {
                unlink($this->config->get('socket_path'));
            }
        }

        //close client side
        if ($this->socket) {
            socket_close($this->socket);
        }
        
        echo "Connection and socket are closed".PHP_EOL;
    } 

    protected function throwExceptionWith($message)
    {
        $error_code = socket_last_error();
        $error_msg = socket_strerror($error_code);

        throw new \Exception("$message: with error [$error_code] $error_msg \n");
    }
}