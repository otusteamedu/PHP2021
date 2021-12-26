<?php

namespace App\Infrastructure\Repositories;

use App\Application\DTO\MessageDTO;
use App\Domain\DataMappers\MessageMapper;
use App\Domain\Models\Message;

class MessagesRepository
{
    private $model;

    public function __construct(MessageMapper $model)
    {
        $this->model = $model;
    }

    public function getAllIdWithImages()
    {
        $sql = "SELECT id FROM `messages` WHERE isset_image = 1";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return new Message($result['id']);
    }
}