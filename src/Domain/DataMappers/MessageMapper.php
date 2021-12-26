<?php

namespace App\Domain\DataMappers;

use App\Application\DTO\MessageDTO;
use App\Domain\Models\Message;

class MessageMapper
{
    private $model;

    public function __construct(Message $model)
    {
        $this->model = $model;
    }
    /**
     * Добавление сообщения
     * @param $user
     * @param $text
     * @return bool
     */
    public function add(MessageDTO $message)
    {
        $sql = "INSERT INTO `messages` (text, `date`, isset_image, user_id) VALUES (:text, :date, :isset_image,:user_id)";
        $statement = $this->getConnect()->prepare($sql);
        $result = $statement->execute(["text" => $message->text,
            "date" => date("y.m.d"),
            "isset_image" => $message->isSetImage ? 1 : 0,
            "user_id" => $message->userId
        ]);
        return $result;
    }

    /**
     * Удаление сообщения
     * @param $id
     */
    public function delete($id)
    {
        $sql = "DELETE FROM messages WHERE id=:id";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute(["id" => $id]);
        return $statement->rowCount();
    }

    /**
     * Получение массива со всеми сообщениями пользователя с определенным id в json формате
     * @param $id
     * @return Message
     */
    public function getAllById($id)
    {
        $sql = "SELECT text FROM `messages` WHERE user_id=:user_id";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute(["user_id" => $id]);
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return new Message($id, $result['text']);
    }
}