<?php declare(strict_types=1);

namespace App\Validator;

interface EmailValidatorInterface
{
    public function validate(string $email): bool;

    public function validateArray(array $emails): array;
}
