<?php

namespace Chat;

class Server 

{
    private Socket $socket;

    private $source = 'server';
    private $messageRead;
    private $messageWrite;

    public function __construct()
    {
        $this->socket = new Socket();
        $this->socket->clearSocket();
        $this->socket->create();
        $this->socket->bind();
        $this->socket->listen();
        $this->socket->accept();
        echo "Для выхода введи: /выход \n";

        do {
            $this->messageRead = $this->socket->read($this->source);
            echo "Ответ: " . $this->messageRead . "\n";
            echo "Введите сообщение: ";
            $this->TextInput();

            if ($this->messageWrite == '/выход') {
                break;
            }
            
            $this->socket->write($this->source, $this->messageWrite);
        } while (true);

        $this->socket->close();
    }

    public function TextInput()
    {
        $this->messageWrite = rtrim(fgets(STDIN));
    }
        
}