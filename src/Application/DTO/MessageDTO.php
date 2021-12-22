<?php

namespace App\DTO;

class MessageDTO
{
    public function __construct($userId, $isSetImage, $text)
    {
        $this->userId = $userId;
        $this->isSetImage = $isSetImage;
        $this->text = $text;
    }
    public $userId;

    public $isSetImage;

    public $text;
}