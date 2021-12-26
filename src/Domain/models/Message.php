<?php

namespace App\Domain\Models;

use App\Application\DTO\MessageDTO;

class Message extends Base
{
    private $text;
    private $date;
    private $isSetImage;
    private $userId;

    public function __construct($text, $date, $isSetImage, $userId)
    {
        $this->text = $text;
        $this->date = $date;
        $this->isSetImage = $isSetImage;
        $this->userId = $userId;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setIsSetImage(bool $isSetImage)
    {
        $this->isSetImage = $isSetImage;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getText($text)
    {
        return $this->text;
    }

    public function getDate($date)
    {
        return $this->date;
    }

    public function getIsSetImage(bool $isSetImage)
    {
        return $this->isSetImage;
    }

    public function getUserId($userId)
    {
        return $this->userId;
    }
}