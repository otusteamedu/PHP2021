<?php
require_once(__DIR__ . '/../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

try {
    $app = new Balance\App();
    $app->run();
} catch (Exception $e) {
}