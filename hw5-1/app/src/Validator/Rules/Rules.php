<?php

declare(strict_types=1);

namespace App\Validator\Rules;

class Rules
{
    public static function get(): array
    {
        return [
            'email'        => EmailRule::class,
            'email-domain' => EmailDomainRule::class,
        ];
    }
}