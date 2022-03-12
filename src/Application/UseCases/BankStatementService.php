<?php

namespace App\Application\UseCases;

use App\Application\Contracts\BankStatementServiceInterface;
use App\Application\Contracts\MailerInterface;
use App\Domain\BankStatement;
use App\Infrastructure\Mailer;
use PHPMailer\PHPMailer\Exception;

class BankStatementService implements BankStatementServiceInterface
{
    private MailerInterface $mailer;

    /**
     * @param Mailer $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @throws Exception
     */
    public function generate(BankStatement $statement): void
    {
        sleep(5);
        $isSent = $this->mailer->mail(
            $statement->getEmail(),
            'Bank Statement',
            sprintf(
                'Statement from %s to %s',
                $statement->getDateFrom(),
                $statement->getDateTo()
            )
        );
        if (!$isSent) {
            throw new Exception('Statement is not sent');
        }
    }
}
