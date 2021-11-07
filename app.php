<?php

use App\App;

require_once('vendor/autoload.php');

try {
    $app = new App($argv[1] ?? null);
    $app->run();
} catch (Exception $e) {
    echo sprintf('Error: %s.%s', $e->getMessage(), PHP_EOL);
}
