<?php

use App\App;
use App\Application\Contracts\ServiceInterface;

require_once('vendor/autoload.php');

try {
    $app = new App($argv[1] ?? ServiceInterface::CLIENT);
    $app->run();
} catch (Exception $e) {
    printf('Error: %s!%s', $e->getMessage(), PHP_EOL);
}
