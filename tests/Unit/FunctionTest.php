<?php

namespace Tests\Unit;

/**
 * Class BaseTest
 * @package Tests
 */
class FunctionTest extends BaseTest
{

    /**
     * @return void
     */
    public function test_is_email(): void
    {
        $this->assertTrue(is_email('yu2ry@rambler.ru'));

        $this->assertFalse(is_email('yu2ry@test.ru'));
        $this->assertFalse(is_email(''));
        $this->assertFalse(is_email((string)rand()));
    }

    /**
     * @return void
     */
    public function test_email_verify(): void
    {
        $this->assertTrue(email_verify('yu2ry@rambler.ru'));
        $this->assertTrue(email_verify('yu2ry@rambler.ru', 'yu2ry@mail.ru'));

        $this->assertFalse(email_verify(''));
        $this->assertFalse(email_verify('yu2ry@rambler.ru', 'yu2ry@mail_test.ru'));
        $this->assertFalse(email_verify((string)rand(), (string)rand()));
    }
}
