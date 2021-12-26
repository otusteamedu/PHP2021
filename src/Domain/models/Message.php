<?php

namespace App\Domain\Models;

use App\Application\DTO\MessageDTO;

class Message
{
    private $id;
    private $text;
    private $date;
    private $isSetImage;
    private $userId;

    public function __construct($id = null, $text = null, $date = null, $isSetImage = null, $userId = null)
    {
        $this->id = $id;
        $this->text = $text;
        $this->date = $date;
        $this->isSetImage = $isSetImage;
        $this->userId = $userId;
    }

    public function setId($id)
    {
        $this->id = $id;
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

    public function getId()
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getIsSetImage()
    {
        return $this->isSetImage;
    }

    public function getUserId()
    {
        return $this->userId;
    }
}