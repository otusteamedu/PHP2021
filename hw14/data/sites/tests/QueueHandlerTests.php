<?php

declare(strict_types=1);

namespace Tests;

use MySite\console\Services\QueueHandler\QueueHandlerService;
use MySite\domain\Support\Facades\Queue;

/**
 * ./vendor/bin/phpunit --testdox ./tests/QueueHandlerTests.php
 *
 * Class QueueHandlerTests
 * @package Tests
 */
class QueueHandlerTests extends BaseTest
{

    public function testQueuePush()
    {
        $result = Queue::pushRaw(
            json_encode(['id' => 0])
        );
        $this->assertTrue($result);
    }
}
