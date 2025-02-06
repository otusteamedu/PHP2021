<?php

namespace App\Infrastructure;

use App\Application\Interfaces\MailAgentInterface;
use PHPMailer\PHPMailer\PHPMailer;

class MailAgent implements MailAgentInterface
{
    private PHPMailer $mailer;

    public function __construct(PHPMailer $mailer)
    {
        $this->mailer = $mailer;
        $this->mailer->isSMTP();
        $this->mailer->Host = 'emailhost';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'emaiuser';
        $this->mailer->Password = 'emailpass';
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mailer->Port = 465;
    }

    public function send(string $to, string $subject, string $body): bool
    {
        $this->mailer->setFrom('emaiuser', 'Mailer');
        $this->mailer->addAddress($to);
        $this->mailer->isHTML(true);
        $this->mailer->Subject = $subject;
        $this->mailer->Body = $body;

        return $this->mailer->send();
    }
}
