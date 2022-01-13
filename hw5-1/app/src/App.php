<?php

declare(strict_types=1);

namespace App;

use App\Console\Console;
use App\Services\EmailsFetcher;
use App\Services\EmailsHandler;
use Exception;

class App
{
    public function run(): void
    {
        try {
            $emails = (new EmailsFetcher())->fetch();

            Console::success('Старт валидации');

            (new EmailsHandler())->handle($emails);

            Console::success('Валидация завершена');
        } catch (Exception $e) {
            Console::error('Error: ' . $e->getMessage());
        }
    }
}
