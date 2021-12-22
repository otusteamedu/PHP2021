<?php

namespace App\Services;

use App\Application\ValueObject\Email;

interface SendEmailInterface
{

    /**
     * Отправка письма
     * @param $email
     * @return mixed
     */
    public function send(Email $email);
}

