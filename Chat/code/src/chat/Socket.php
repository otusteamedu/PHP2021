<?php

namespace Chat;

use Chat\Env;

class Socket 

{
    
    private $socket;
    private $host;
    private $port;
    private $accept;

    public function __construct()
    {
        $this->env = new Env();
        $this->host = $this->env->host;
        $this->port = $this->env->host;;
    }

    public function clearSocket()
    {
        if (file_exists($this->host)) {
            unlink($this->host);
        }
    }

    public function create()
    {
        $this->socket = socket_create(AF_UNIX, SOCK_STREAM, 0);
    }

    public function connect()
    {
        socket_connect($this->socket, $this->host, $this->port);
    }

    public function bind()
    {
        socket_bind($this->socket, $this->host, $this->port);
    }

    public function listen()
    {
        socket_listen($this->socket);
    }

    public function accept()
    {
        $this->accept = socket_accept($this->socket);
    }

    public function write($source, $message)
    {
        if ($source == 'client') {
            socket_write($this->socket, $message,  strlen($message));
        } elseif ($source == 'server') {
            socket_write($this->accept, $message,  strlen($message));
        }
        
    }

    public function read($source)
    {
        if ($source == 'client') {
            $messageRead = socket_read($this->socket, 1024);
        } elseif ($source == 'server') {
            $messageRead = socket_read($this->accept, 1024);
        }

        return $messageRead;
    }

    public function close()
    {
        if (!$this->socket) {
            return;
        }
        
        socket_close($this->socket);
    }
}