<?php

namespace App\Services;

use Swift_Attachment;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class SendEmail implements SendEmailInterface
{

    /**
     * Отправка сообщения об успешной регистрации
     * @param $email
     * @return mixed|void
     */
    public function send($email)
    {
        $transport = (new Swift_SmtpTransport('smtp.mail.ru', 465, 'ssl'))
            ->setUsername(EMAIL)
            ->setPassword(EMAIL_PASS)
        ;

        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message('Reg'))
            ->setFrom([EMAIL => $email])
            ->setTo([$email])
            ->setBody('Reg success')
        ;
        $mailer->send($message);
    }
}