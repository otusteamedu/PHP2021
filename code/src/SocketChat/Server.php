<?php

namespace Dmigrishin\Chat\SocketChat;

use Dmigrishin\Chat\SocketChat\Socket;

class Server extends Socket

{

    function __construct()
    {
        parent::__construct();
    }

    public static function startserver()
    {
        $server = new Server();
        $server->initserver();
        
        return $server;
    }

    function initserver()
    {
        $this->clearOldSocket();
        $this->create();
        $this->bind();
        $this->set_option();
        $this->listen();
    }

    //server app
    public function serve(): void
    {
        echo 'Waiting for connections...' . PHP_EOL;
        echo "Press any key for continue: (for exit - /exit)";
            $this->TextInput();
            $this->serveraccept = socket_accept($this->socket); 
            if ($this->serveraccept !== false) {

                echo 'Client connected...' . PHP_EOL;

            } else {

                throw new Exception("Couldn't accept connected socket" . socket_strerror(socket_last_error()) . PHP_EOL);
                
            }

            while (true) { 
                
                if ($this->writemessage == '/exit') {
                    break;
                }    
                    
                $this->messageRead = $this->read('server') . PHP_EOL;
                echo $this->messageRead;
    
            }

            $this->close();
    }
}