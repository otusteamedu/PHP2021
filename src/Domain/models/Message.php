<?php

namespace App\Models;

class Message extends Base
{
    public function getAllIdWithImages()
    {
        $sql = "SELECT id FROM `micro_blog_messages` WHERE isset_image = 1";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Получение всех сообщений
     * @return array
     */
    public function getAll()
    {
        $sql = "SELECT micro_blog_messages.id, text, date, name FROM micro_blog_messages INNER JOIN micro_blog ON micro_blog.id = micro_blog_messages.user_id ORDER BY id DESC LIMIT 3";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Добавление сообщения
     * @param $user
     * @param $text
     * @return bool
     */
    public function add($userId, $isSetImage, $text)
    {
        $sql = "INSERT INTO `micro_blog_messages` (text, `date`, isset_image, user_id) VALUES (:text, :date, :isset_image,:user_id)";
        $statement = $this->getConnect()->prepare($sql);
        $result = $statement->execute(["text" => $text,
            "date" => date("y.m.d"),
            "isset_image" => $isSetImage ? 1 : 0,
            "user_id" => $userId
        ]);
        return $result;
    }

    /**
     * Удаление сообщения
     * @param $id
     */
    public function delete($id)
    {
        $sql = "DELETE FROM micro_blog_messages WHERE id=:id";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute(["id" => $id]);
        return $statement->rowCount();
    }

    /**
     * Получение массива со всеми сообщениями пользователя с определенным id в json формате
     * @param $id
     * @return false|string
     */
    public function getAllById($id)
    {
        $sql = "SELECT text FROM `micro_blog_messages` WHERE user_id=:user_id";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute(["user_id" => $id]);
        return json_encode($statement->fetchAll(\PDO::FETCH_ASSOC));
    }
}