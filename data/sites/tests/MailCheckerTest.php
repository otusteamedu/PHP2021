<?php


namespace Tests;

use MySite\Features\MailChecker\App;
use MySite\Http\HttpCodes;
use MySite\Http\Request;
use MySite\Http\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class MailCheckerTest
 * @package Tests\MailCheckerTest
 * ./vendor/bin/phpunit --testdox ./tests/MailCheckerTest.php
 *
 */
class MailCheckerTest extends TestCase
{

    private const GOOD_EMAIL = '33uv0wsqa@relay.firefox.com';
    private const BAD_EMAIL = 'test@test.ru';

    public function testRunMethod()
    {
        $request = new Request();

        $request->withParsedBody(
            [
                'email' => self::GOOD_EMAIL
            ]
        );
        $response = (new App())->run($request);

        $this->assertEquals(HttpCodes::OK, $response->getStatusCode());

        $request->withParsedBody(
            [
                'email' => self::BAD_EMAIL
            ]
        );
        $response = (new App())->run($request);

        $this->assertEquals(HttpCodes::BAD_REQUEST, $response->getStatusCode());
    }
}
