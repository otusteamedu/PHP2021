<?php

namespace Chat;

class Client 

{
    private Socket $socket;

    private $source = 'client';
    private $messageRead;
    private $messageWrite;
    
    public function __construct()
    {        
        $this->socketCreate();
    }

    public function socketCreate()
    {
        $this->socket = new Socket();
        $this->socket->create();
        $this->socket->connect();
    
        do {
            echo 'Введите сообщение: ';
            $this->TextInput();
            $this->socket->write($this->source, $this->messageWrite);
            $this->messageRead = $this->socket->read($this->source);
            echo "Ответ: " . $this->messageRead . "\n";
        } while (true);

        close();
    }
    
    public function TextInput()
    {
        $this->messageWrite = rtrim(fgets(STDIN));
    }
}