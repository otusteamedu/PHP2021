<?php

namespace App\Telegram;

use App\Telegram\Key;
use Telegram\Bot\Api;

class SendMessage
{
    private string $key;
    private $data;
    private object $telegram;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->key = (new Key)->Key();

        $this->telegram = new Api($this->key);
        $this->telegram->sendMessage(
            [ 
                'chat_id' => $this->data['chatId'], 
                'text' => 'Запрос на получение выписки с ' . $this->data['dateWith'] . ' по ' . $this->data['dateBeforee'] . ' принят в обработку'
            ]
        );
    }

}