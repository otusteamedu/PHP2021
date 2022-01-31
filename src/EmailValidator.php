<?php

namespace App;

class EmailValidator
{
    private const
        EMAIL_NAME_MAX_LENGTH = 64,
        EMAIL_DOMAIN_MAX_LENGTH = 255;

    public const
        EMAIL_SYNTAX_ERROR = 'syntax error',
        EMAIL_MX_RECORD_NOT_FOUND = 'mx record not found',
        EMAIL_VALID = 'valid';

    /**
     * @param array $emails
     * @return array
     */
    public function validateEmails(array $emails): array
    {
        $result = [];

        foreach ($emails as $email) {
            $parts = explode('@', $email);

            if (count($parts) !== 2) {
                $result[$email] = self::EMAIL_SYNTAX_ERROR;
                continue;
            }

            [$name, $domain] = $parts;
            if (mb_strlen($name) > self::EMAIL_NAME_MAX_LENGTH || mb_strlen($domain) > self::EMAIL_DOMAIN_MAX_LENGTH) {
                $result[$email] = self::EMAIL_SYNTAX_ERROR;
                continue;
            }

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $result[$email] = self::EMAIL_SYNTAX_ERROR;
                continue;
            }

            $hosts   = [];
            if (!getmxrr($domain, $hosts)) {
                $result[$email] = self::EMAIL_MX_RECORD_NOT_FOUND;
                continue;
            }

            $result[$email] = self::EMAIL_VALID;
        }

        return $result;
    }
}
