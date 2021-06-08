<?php declare(strict_types=1);

namespace App\Validator;

class BracketsValidator implements BracketsValidatorInterface
{
    /**
     * @throws \InvalidArgumentException
     */
    public function validate(string $brackets): bool
    {
        $chars = mb_str_split($brackets);
        $balance = 0;

        foreach ($chars as $char) {
            switch ($char) {
                case '(':
                    ++$balance;
                    break;
                case ')':
                    --$balance;
                    if ($balance < 0) {
                        return false;
                    }
                    break;
                default:
                    throw new \InvalidArgumentException("Unexpected char $char");
            }
        }

        return $balance === 0;
    }
}
