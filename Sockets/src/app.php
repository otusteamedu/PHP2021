<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $app = (new App\App())->run($argv);
} catch (Exception $e) {
    echo $e->getMessage();
}
