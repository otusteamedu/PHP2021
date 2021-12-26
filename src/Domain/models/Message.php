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

    public function getId($id)
    {
        return $this->id;
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