<?php declare(strict_types=1);

use App\App;

require_once('vendor/autoload.php');

try {
    $app = new App();
    $app->handle();
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
