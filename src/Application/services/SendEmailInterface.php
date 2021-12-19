<?php

namespace App\Services;

interface SendEmailInterface
{

    /**
     * Отправка письма
     * @param $email
     * @return mixed
     */
    public function send($email);
}

