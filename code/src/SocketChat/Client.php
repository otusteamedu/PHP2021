<?php

namespace Dmigrishin\Chat\SocketChat;

class Client extends Socket
{   

    public static function startclient()
    {
        $client = new Client();
        $client->initclient();
        
        return $client;
    }

    function initclient():void 
    {
        $this->create();
        $this->connect();
    }

    //приложение клиента
    public function communicate()
    {
        echo "For exit: /exit \n";

        do {
            echo 'Enter message: ';
            $this->TextInput();

            if ($this->writemessage == '/exit') {
                break;
            }       
            $this->write('client', $this->writemessage);
            
        } while (true);

        $this->close();
    }
}