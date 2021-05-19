<?php

require_once(__DIR__ . '/../vendor/autoload.php');

use App\App;

(Dotenv\Dotenv::createImmutable(__DIR__ . '/../'))->load();

try {
    $app = new App($argv[1] ?? '');
    $app->run();
} catch (Exception $e) {
    echo $e->getMessage();
}