<?php

namespace Dmigrishin\Chat\SocketChat;

use Exception;

class Socket 

{
    //server parameters
    public $socket = null;
    private $bind = null;
    private $option = null;
    private $listen = null;
    private $host = null;
    private $port = null;
    
    //communication parameters
    public $clientconnect = null;
    public $serveraccept = null;
    
    public $readmessage = null;
    public $writemessage = null;


    function __construct()
    {    
        $this->host = 'socket.sock';
        $this->port = 9999;
    }

    //server functions
    public function create(): void
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
        
        if ($this->socket === false) {
           
            throw new Exception("Couldn't create socket" . socket_strerror(socket_last_error()) . PHP_EOL);

        }
    }

    public function bind(): void
    {   
        $this->bind = socket_bind($this->socket, $this->host, $this->port);
        
        if (false === $this->bind) {
            
            throw new Exception("Couldn't bind socket" . socket_strerror(socket_last_error()) . PHP_EOL);
        
        }

    }
    
    public function set_option(): void
    {
        $this->option = socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, 1);
        if (false === $this->option) {

            throw new Exception("Couldn't set port for several connections" . socket_strerror(socket_last_error()) . PHP_EOL);
        
        }
    }
    
    public function listen(): void
    {
        $this->listen = socket_listen($this->socket); // слушаем сокет
        
        if (false === $this->listen) {

            throw new Exception("Couldn't set listen connections" . socket_strerror(socket_last_error()) . PHP_EOL);
        
        }
    }

    //очищаем старый сокет
    public function clearOldSocket(): void
    {
        if (file_exists($this->host)) {
            unlink($this->host);
        }
    }
    //клиентские функции
    public function connect(): void
    {
        $this->clientconnect = socket_connect($this->socket, $this->host, $this->port);
        if ($this->clientconnect === false) {
            throw new Exception("Couldn't establish connections" . socket_strerror(socket_last_error()) . PHP_EOL);
        }
    }
    

    public function close():void
    {
        socket_close($this->socket);   
    }

    public function TextInput()
    {
        $this->writemessage = rtrim(fgets(STDIN));
    }

    public function read($source)
    {
        if ($source == 'client') {
            $readmessage = socket_read($this->socket, 1024);
        } elseif ($source == 'server') {
            $readmessage = socket_read($this->serveraccept, 1024);
        }

        return $readmessage;
    }

    public function write($source, $message)
    {
        if ($source == 'client') {
            socket_write($this->socket, $message,  strlen($message));
        } elseif ($source == 'server') {
            socket_write($this->accept, $message,  strlen($message));
        }
    }
}