<?php


use Src\Boot;

require __DIR__ . '/vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    (new Boot())->run($argv);
} catch (Exception $e) {
    print_r($e->getMessage() . PHP_EOL);
}
