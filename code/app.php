<?php

require_once 'vendor/autoload.php';

use Vshepelev\App\App;
use Vshepelev\App\Config;
use Vshepelev\App\Exceptions\CommandException;

try {
    error_reporting(E_ERROR | E_PARSE);
    set_time_limit(0);
    ob_implicit_flush();

    $config = new Config(__DIR__ . '/config.ini');
    $app = new App($config);
    $app->run(...$argv);
} catch (CommandException $e) {
    echo $e->getMessage() . PHP_EOL;
}