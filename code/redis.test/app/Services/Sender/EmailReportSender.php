<?php

declare(strict_types=1);

namespace App\Services\Sender;

use Swift_Message;

final class EmailReportSender extends EmailSender
{

    private const DEFAULT_SUBJECT = 'Отчет';

    /**
     * @param array $data
     * @return bool
     */
    public function send(array $data): bool
    {

        $subject = $data['input_params']['subject'] ?? self::DEFAULT_SUBJECT;
        $to = $data['input_params']['replyTo'] ?? $this->defaultTo;

        $resultData = json_encode($data['data'] ?? []);

        $message = (new Swift_Message($subject))
            ->setFrom([$this->defaultFrom])
            ->setTo([$to])
            ->setBody('Вы запрашивали отчет (результаты)): ' . $resultData)
        ;

        $result = $this->getMailer()->send($message);

        return $result > 0;
    }
}
