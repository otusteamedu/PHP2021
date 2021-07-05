<?php declare(strict_types=1);

namespace App\Validator;

use App\Cache\CacheInterface;

class EmailValidator implements EmailValidatorInterface
{
    public function __construct(
        private CacheInterface $cache
    ) {
    }

    public function validateArray(array $emails): array
    {
        return array_filter($emails, fn ($email) => $this->validate($email));
    }

    public function validate(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return false;
        }

        $hostname = explode('@', $email)[1];

        $isValid = $this->cache->get($hostname);
        if ($isValid !== false) {
            return (bool)$isValid;
        }

        $isValid = getmxrr($hostname, $hosts);
        $this->cache->set($hostname, (int)$isValid, 60 * 60);

        return $isValid;
    }
}
