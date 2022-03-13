<?php

namespace App\Application\Contracts;

interface MailerInterface
{
    public function mail(string $to, string $subject, string $body): bool;
}
