<?php

use app\App;

require_once('vendor/autoload.php');

try {
    $app = new App();
    $app->run($argv);
} catch (Throwable $exception) {
    echo $exception->getMessage();
}
