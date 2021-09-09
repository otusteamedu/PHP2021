<?php

require_once('./vendor/autoload.php');

try {
    $app = new App\App();
    $app->run($argv);
} catch (Exception $e) {
    echo $e->getMessage();
}