<?php declare(strict_types=1);

use App\App;

require_once('vendor/autoload.php');

try {
    $app = new App($argv);

    if ($app->isAllRun()) {
        $app->run();
    }
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
