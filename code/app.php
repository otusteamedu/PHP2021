<?php

require_once('vendor/autoload.php');

try {
    $app = new App\Application();
    $result = $app->run();

    $app->handleResult($result);
} catch (Exception $e) {
    echo $e;
}
