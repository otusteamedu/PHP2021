<?php
include __DIR__ . "\..\config.php";

$container = require __DIR__ . '/container.php';
$app = new \App\App();

return $app;

