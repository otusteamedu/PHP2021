<?php

namespace App\Infrastructure;

use App\Application\Contracts\MailerInterface;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer implements MailerInterface
{
    private PHPMailer $client;

    /**
     * @param PHPMailer $client
     */
    public function __construct(PHPMailer $client)
    {
        $this->client = $client;
        $this->client->isSMTP();
        $this->client->Host = getenv('EMAIL_HOST');
        $this->client->SMTPAuth = true;
        $this->client->Username = getenv('EMAIL_USER');
        $this->client->Password = getenv('EMAIL_PASS');
        $this->client->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->client->Port = 465;
    }

    /**
     * @throws Exception
     */
    public function mail(string $to, string $subject, string $body): bool
    {
        $this->client->setFrom(getenv('EMAIL_USER'), 'Mailer');
        $this->client->addAddress($to);
        $this->client->isHTML(true);
        $this->client->Subject = $subject;
        $this->client->Body = $body;

        return $this->client->send();
    }
}
