<?php

namespace App\Request;

use App\Queue\Producer;
use App\Telegram\SendMessage;

class Accepted
{
    
    private array $data;
    private object $producer;

    public function __construct()
    {
        $this->data['chatId'] = $_POST['id_telegram'];
        $this->data['dateWith'] = $_POST['date_with'];
        $this->data['dateBeforee'] = $_POST['date_before'];
    }

    public function Accepted()
    {
        new SendMessage($this->data);

        $this->producer = new Producer($this->data);
        $this->producer->Producer();
        
        echo "Ваша заявка принята в работу!";

    }
}