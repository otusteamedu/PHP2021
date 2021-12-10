<?php

namespace Tests\Unit;

use Yu2ry\Support\Validations\Rules\RuleData;
use Yu2ry\Support\Validations\Rules\RuleEmail;
use Yu2ry\Support\Validations\Rules\RuleEmails;
use Yu2ry\Support\Validations\Validator;

/**
 * Class RulesTest
 * @package Tests\Unit
 */
class RulesTest extends BaseTest
{

    /**
     * @covers \Yu2ry\Support\Validations\Rules\RuleEmail
     */
    public function test_rule_email(): void
    {
        $validator = $this->makeValidator();
        $validator->addRule(
            RuleEmail::factory(
                new RuleData(rand())
            )
        );
        $this->assertFalse($validator->passes());

        $validator = $this->makeValidator();
        $validator->addRule(
            RuleEmail::factory(
                new RuleData('test@rambler.ru')
            )
        );
        $this->assertTrue($validator->passes());

        $validator = $this->makeValidator();
        $validator->addRule(
            RuleEmail::factory(
                new RuleData('test@ramblwer.ru')
            )
        );
        $this->assertFalse($validator->passes());
    }

    /**
     * @covers \Yu2ry\Support\Validations\Rules\RuleEmail
     */
    public function test_rule_emails(): void
    {
        $validator = $this->makeValidator();
        $validator->addRule(
            RuleEmails::factory(
                new RuleData([rand()])
            )
        );
        $this->assertFalse($validator->passes());

        $validator = $this->makeValidator();
        $validator->addRule(
            RuleEmails::factory(
                new RuleData(['test@rambler.ru'])
            )
        );
        $this->assertTrue($validator->passes());

        $validator = $this->makeValidator();
        $validator->addRule(
            RuleEmails::factory(
                new RuleData(['test@ramblwer.ru'])
            )
        );
        $this->assertFalse($validator->passes());
    }

    /**
     * @return Validator
     */
    protected function makeValidator(): Validator
    {
        return new Validator();
    }
}