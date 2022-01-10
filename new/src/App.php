<?php

declare(strict_types=1);

namespace App;

use App\Infrastructure\EmailVariation;
use App\Infrastructure\RecordMX;

class App
{
    private string $emailVar;

    public function __construct(string $email)
    {
        $this->emailVar = $email;
    }

    public function run()
    {
        //Проверка на валидацию
        $app1 = new EmailVariation($this->emailVar);
        $app1->run();

        //Проверка на MX запись
        $app2 = new RecordMX($this->emailVar);
        $app2->run();
    }
}