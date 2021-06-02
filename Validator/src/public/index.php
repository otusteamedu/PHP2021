<?php

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $app = (new App\App())->run();
} catch (Exception $e) {
    echo $e->getMessage();
}
