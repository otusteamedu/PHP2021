<?php

namespace App\Queue;

use App\Rabbit\Manufacturer;

class Producer {

    private $message;

    public function __construct(array $data)
    {
        $this->message = [
            'chatId' => $data['chatId'],
            'dateWith' => $data['dateWith'],
            'dateBeforee'=> $data['dateBeforee']
        ];
    }

    public function Producer() {

        (new Manufacturer($this->message))->Manufacturer();

    }

}