<?php

declare(strict_types=1);

namespace App;

use App\Infrastructure\Services\ReceiverRabbitMQ;

require_once('vendor/autoload.php');

try {
    (new ReceiverRabbitMQ())->execute();
} catch (\Exception $e) {
    echo $e->getMessage().PHP_EOL;
}