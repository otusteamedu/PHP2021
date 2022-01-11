<?php

namespace App\Telegram;

use App\Telegram\Key;
use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;

class SendDocument
{
    private string $key;
    private $chatId;
    private $inputFile;
    private $url;
    private object $telegram;

    public function __construct(array $data)
    {
        $this->key = (new Key)->Key();
        $this->chatId = $data['chatId'];
        $this->url = $data['url'];

        $this->telegram = new Api($this->key);
        
        $this->inputFile = new InputFile;
        $this->url = $this->inputFile->create($this->url);

        $this->telegram->sendDocument([ 'chat_id' => $this->chatId, 'document' => $this->url, 'caption' => "Описание" ]);
    }


}