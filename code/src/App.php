<?php

namespace App;

class App
{
    public function run(): void
    {
        $emailValidator = new EmailValidator();

        $emails = [
            "olegsv3007@yandex.ru",
            "example@yandex.ru",
            "example@yyyyandex.ru",
            "example.yandex.ru",
            "example",
            "example@@yandex.ru",
            "hello@gmail.com",
        ];

        $correctEmails = $emailValidator->validateArray($emails);

        print_r($correctEmails);
    }
}
