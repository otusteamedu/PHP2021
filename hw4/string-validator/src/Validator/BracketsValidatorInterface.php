<?php declare(strict_types=1);

namespace App\Validator;

interface BracketsValidatorInterface
{
    /**
     * @throws \InvalidArgumentException
     */
    public function validate(string $brackets): bool;
}
