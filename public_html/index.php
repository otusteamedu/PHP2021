<?php
include "../vendor/autoload.php";
$config = \App\Application\Services\Config::getInstance();
$config = \PHLAK\Config\Config::fromDirectory(__DIR__ . "/../config/");

$app = new \App\App();



