<?php

namespace App\Service;


class SendEmail
{
    public function send(array $post): bool
    {

        return mail('profox@profox.pro', 'My Subject', 'Банковская выписка готова');

    }
}
