<?php

namespace App\Application\Interfaces;

interface MailAgentInterface
{
    public function send(string $to, string $subject, string $body): bool;
}
