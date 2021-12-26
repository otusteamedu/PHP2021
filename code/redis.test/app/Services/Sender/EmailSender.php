<?php

namespace App\Services\Sender;

use App\Services\Sender;
use Swift_Mailer;
use Swift_SmtpTransport;

abstract class EmailSender implements Sender
{

    private string $host;

    private string $port;

    private string $smtpUser;

    private string $smtpUserPassword;

    protected string $defaultFrom;

    protected string $defaultTo;

    public function __construct()
    {
        $this->host = env("MAIL_HOST", "localhost");
        $this->port = env("MAIL_PORT", "465");
        $this->smtpUser = env("MAIL_USER", "test@test.test");
        $this->smtpUserPassword = env("MAIL_PASSWORD", "12345678");
        $this->defaultFrom = env("MAIL_DEFAULT_FROM", "test@test.test");
        $this->defaultTo = env("MAIL_DEFAULT_TO", "test@test.test");
    }

    protected function getMailer(): Swift_Mailer {
        $transport = (new Swift_SmtpTransport($this->host, $this->port))
            ->setUsername($this->smtpUser)
            ->setPassword($this->smtpUserPassword);

        return new Swift_Mailer($transport);
    }

    /**
     * @inheritDoc
     */
    public abstract function send(array $data): bool;

}
