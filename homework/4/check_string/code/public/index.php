<?php

require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

use App\RequestHandler;

$handler = new RequestHandler();

try {
    $handler->handle();
} catch (Throwable $e) {
    $handler->sendServerError($e);
}
