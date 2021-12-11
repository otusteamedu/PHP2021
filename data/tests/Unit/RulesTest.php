<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Yu2ry\Support\Validations\Rules\AbstractRule;
use Yu2ry\Support\Validations\Rules\ParenthesesRule;
use Yu2ry\Support\Validations\Rules\RuleData;
use Yu2ry\Support\Validations\Validator;

/**
 * Class RulesTest
 * @package Tests\Unit
 */
class RulesTest extends TestCase
{

    /**
     * @covers \Yu2ry\Support\Validations\Rules\ParenthesesRule
     * @return void
     */
    public function test_parentheses(): void
    {
        $validator = new Validator();
        $validator->addRule(
            new ParenthesesRule(
                new RuleData('()()()()(((())))((((()))))')
            )
        );
        $this->assertTrue($validator->passes());

        $validator = new Validator();
        $validator->addRule(
            new ParenthesesRule(
                new RuleData('()()()()(((())))((((())))))')
            )
        );
        $this->assertFalse($validator->passes());
    }
}