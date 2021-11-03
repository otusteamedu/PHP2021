<?php

require_once(dirname(__FILE__) . '/vendor/autoload.php');

use App\App;

try {
    $app = new App();
    $app->run($argv[1] ?? '');
} catch(Throwable $e) {
    echo $e->getMessage() . PHP_EOL;
}
