<?php

namespace App\Jobs;

use App\Service\SendEmail;

class BankStatementJob extends Job
{
    private string $email;

    public function handle()
    {
        //ведем сложные вычесления
        sleep(20);

        //отправляем ответ
        $sendEmail = new SendEmail;
        $sendResult = $sendEmail->send($this->getEmail());
        if ($sendResult) {
            echo 'Выписка отправлена';
        }
        else
        {
            echo 'Возникла ошибка при отправке';
        }
    }

    /**
     * @return array
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param array $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
