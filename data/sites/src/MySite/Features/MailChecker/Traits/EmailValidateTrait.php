<?php

declare(strict_types=1);

namespace MySite\Features\MailChecker\Traits;

/**
 * Trait EmailValidateTrait
 * @package MySite\Features\MailChecker\Traits
 */
trait EmailValidateTrait
{
    /**
     * @param string $email
     * @return array
     */
    private static function getNameAndDomain(string $email): array
    {
        $result = [
            'name' => null,
            'domain' => null,
        ];
        $explodedEmail = explode('@', $email);
        if ($explodedEmail) {
            $result = [
                'name' => $explodedEmail[0],
                'domain' => $explodedEmail[1],
            ];
        }
        return $result;
    }
}
