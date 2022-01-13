<?php

declare(strict_types=1);

namespace App\Services;

use App\Console\Console;
use App\EmailValidator\EmailValidator;
use App\EmailValidator\ValidationException;
use Exception;

class EmailsHandler
{
    /**
     * @throws Exception
     */
    public function handle(array $emails): void
    {
        $this->throwExceptionIfEmailListIsNotSpecified($emails);

        foreach ($emails as $email) {
            $this->validationEmail($email);
        }
    }

    /**
     * @throws Exception
     */
    private function throwExceptionIfEmailListIsNotSpecified(array $emails): void
    {
        if (!$emails) {
            throw new Exception('Не указан список адресов электронной почты');
        }
    }

    /**
     * @throws Exception
     */
    private function validationEmail(string $email): void
    {
        try {
            EmailValidator::validate($email);

            Console::success($email . ' ... ok');
        } catch (ValidationException $e) {
            Console::error($email . ' ... ' . $e->getMessage());
        }
    }
}