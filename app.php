<?php

require_once('vendor/autoload.php');

try {
    (new Project\App())->run($argv);
} catch (Exception $e) {
    var_dump($e);
}