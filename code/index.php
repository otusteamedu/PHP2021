<?php declare(strict_types=1);

use App\App;
use App\Services\ResponseService;

require_once('vendor/autoload.php');

try {
    $app = new App();

    if ($app->isNotEmptyParams()) {
        $app->handle();
    } else {
        (new ResponseService())->notFound();
    }
} catch (Exception $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
