<?php

namespace App\Application\UseCases;

use App\Application\Contracts\BankStatementServiceInterface;
use App\Application\Contracts\MailerInterface;
use App\Domain\BankStatement;
use App\Infrastructure\Mailer;
use Exception;

class BankStatementService implements BankStatementServiceInterface
{
    private MailerInterface $mailer;
    private BankStatement $statement;

    /**
     * @param Mailer $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function getStatement(): BankStatement
    {
        return $this->statement;
    }

    /**
     * @throws Exception
     */
    public function execute(string $req): void
    {
        $this->setStatement($req);
        $this->generate();
        $isSent = $this->mailer->mail(
            $this->statement->getEmail(),
            'Bank Statement',
            sprintf(
                'Statement from %s to %s',
                $this->statement->getDateFrom(),
                $this->statement->getDateTo()
            )
        );
        if (!$isSent) {
            throw new Exception('Statement is not sent');
        }
    }

    /**
     * @throws Exception
     */
    private function setStatement(string $str): void
    {
        $body = json_decode($str, true);
        if (is_null($body)) {
            throw new Exception('incorrect request body');
        }

        $this->statement = new BankStatement(
            $body['date_from'], $body['date_to'], $body['email']
        );
    }

    private function generate(): void
    {
        sleep(5);
    }
}
