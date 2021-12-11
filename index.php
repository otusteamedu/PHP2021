<?php

use App\App;

require_once('vendor/autoload.php');

try {
    $app = new App();
    $app->run();
} catch (Exception $e) {
    http_response_code($e->getCode());
    printf('Error: %s!%s', $e->getMessage(), PHP_EOL);
}
