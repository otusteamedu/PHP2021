<?php

declare(strict_types=1);

namespace App\EmailValidator;

use App\EmailValidator\Rules\RuleInterface;
use App\EmailValidator\Rules\Rules;
use Exception;
use UnexpectedValueException;

class EmailValidator
{
    private static array $rules = [
        'email',
        'email-domain',
    ];

    /**
     * @throws ValidationException
     * @throws Exception
     */
    public static function validate($value): void
    {
        foreach (static::$rules as $rule) {
            if (!$rule) {
                continue;
            }

            [
                $ruleName,
                $ruleParam,
            ] = RuleParser::parse($rule);

            $rule = static::createRule($ruleName, $ruleParam);

            if (!$rule->validate($value)) {
                throw new ValidationException($rule->getErrorMessage());
            }
        }
    }

    private static function createRule(string $ruleName, $ruleParam): RuleInterface
    {
        $ruleClassName = static::getRuleClassName($ruleName);

        return ($ruleParam ? new $ruleClassName($ruleParam) : new $ruleClassName());
    }

    private static function getRuleClassName(string $ruleName): string
    {
        $rules = Rules::get();

        if (empty($rules[$ruleName])) {
            throw new UnexpectedValueException("Правило $ruleName не найдено");
        }

        return $rules[$ruleName];
    }
}