<?php

namespace App\Application\Services;

use App\Application\UseCase\CheckAuthStatus;
use App\Application\ValueObject\Email;
use Swift_Attachment;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

    class SendEmail implements SendEmailInterface
    {
        private $authService;

        public function __construct(CheckAuthStatus $authService)
        {
            $this->authService = $authService;
        }
        /**
         * Отправка сообщения об успешной регистрации
         * @param $email
         * @return mixed|void
         */
        public function send(Email $email)
        {
            $transport = (new Swift_SmtpTransport(Config::get('EMAIL_HOST'), Config::get('EMAIL_PORT')))
                ->setUsername(Config::get('USERNAME'))
                ->setPassword(Config::get('EMAIL_PASS'));

            $mailer = new Swift_Mailer($transport);

            $body = 'Reg success';

            if ($this->authService->user()) {
                $body = 'Reg another account success';
            }

            $message = (new Swift_Message('Reg'))
                ->setFrom([Config::get('EMAIL_TO')])
                ->setTo([ $email->getValue()])
                ->setBody($body);

            $mailer->send($message);
        }
    }