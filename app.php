<?php

require_once('vendor/autoload.php');

try {
    $app = PHP_SAPI == 'cli' ? new Project\CliApp() : new Project\App();
    $app->run($argv);
} catch (Exception $e) {
    var_dump($e);
}