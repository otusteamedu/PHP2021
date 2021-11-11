<?php declare(strict_types=1);

namespace App\Services;

class ValidateEmailService
{
    public function handle(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !getmxrr(explode('@', $email)[1], $mx_records)) {
            throw new \Exception("Wrong email", 400);
        }
    }
}
