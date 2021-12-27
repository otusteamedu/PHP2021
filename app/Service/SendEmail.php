<?php

namespace App\Service;


class SendEmail
{
    public function send(string $email): bool
    {

        return mail($email, 'Банковская выписка', 'Банковская выписка готова');

    }
}
