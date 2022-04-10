<?php

use MySite\console\Services\QueueHandler\QueueHandlerService;

require_once(__DIR__ . '/../vendor/autoload.php');

try {
    (new QueueHandlerService())->run();
} catch (Exception $e) {
    echo $e->getMessage();
}
