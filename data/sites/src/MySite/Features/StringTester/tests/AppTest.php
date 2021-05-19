<?php

namespace MySite\Features\StringTester\Test;

use MySite\Features\StringTester\App;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{


    /**
        ./vendor/bin/phpunit --testdox ./src/MySite/Features/StringTester/tests/AppTest.php

        App (MySite\Features\StringTester\Test\App)
        ✔ Run method

        OK (1 test, 2 assertions)
     */
    public function testRunMethod()
    {
        $app = new App;
        //Good case
        $goodStr = '(.)(.)';
        $result = $app->checkString($goodStr);
        $this->assertTrue($result);

        //Bad case
        $badStr = ')(';
        $result = $app->checkString($badStr);
        $this->assertFalse($result);
    }
}
