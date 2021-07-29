<?php
require_once(__DIR__ . '/../vendor/autoload.php');

try {
    $app = new Brackets\App();
    $app->run();
} catch (Exception $e) {
}