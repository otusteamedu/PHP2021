<?php

namespace App\Infrastructure\DataMappers;

use App\Application\DTO\MessageDTO;
use App\Application\Services\MessageMapperInterface;
use App\Domain\Models\Message;

class MessageMapper extends BaseMapper implements MessageMapperInterface
{
    private $model;

    public function __construct(Message $model)
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

    /**
     * Получение всех сообщений
     * @return array
     */
    public function getAll()
    {
        $sql = "SELECT messages.id, text, date, name FROM messages INNER JOIN users ON users.id = messages.user_id ORDER BY id DESC LIMIT 3";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute();
        $messages = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $result = [];
        foreach ($messages as $message) {
            $result[] = new Message($message['id'], $message['text']);
        }
        return $result;
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
     * @return array
     */
    public function getAllById($id)
    {
        $sql = "SELECT text FROM `messages` WHERE user_id=:user_id";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute(["user_id" => $id]);
        $messages = $statement->fetchAll(\PDO::FETCH_ASSOC);
        $result = [];
        foreach ($messages as $message) {
            $result[] = new Message($id, $message['text']);
        }
        return $result;
    }
}