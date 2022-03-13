<?php

use App\App;

require_once('vendor/autoload.php');

try {
    $app = new App();
    $app->run();
} catch (Exception $e) {
    printf('Error: %s!%s', $e->getMessage(), PHP_EOL);
}
