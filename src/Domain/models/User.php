<?php

namespace App\Models;

class User extends Base
{
    /**
     * Запрос пользователя по email
     * @param $email
     * @return bool
     */
    public function get($email)
    {
        $sql = "SELECT * FROM micro_blog WHERE `email` = :user_email";
        $statement = $this->getConnect()->prepare($sql);
        $statement->execute(["user_email" => $email]);
        return $statement->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Добавление пользователя в базу
     * @param $user
     * @return bool
     */
    public function add($user)
    {
        $sql = "INSERT INTO micro_blog (email, password, `name`, register_date) VALUES (:email, :password, :name, :register_date)";
        $statement = $this->getConnect()->prepare($sql);
        return $statement->execute(["email" => $_POST["email"], "password" => password_hash($_POST["password"], PASSWORD_BCRYPT), "name" => $_POST["name"], "register_date" => date("y.m.d")]);
    }
}
