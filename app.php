<?php

use App\App;

require_once('vendor/autoload.php');

try {
    $app = new App($argv[1] ?? null);
    $app->run();
} catch (Exception $e) {
    printf('Error: %s.%s', $e->getMessage(), PHP_EOL);
}
