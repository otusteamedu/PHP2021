<?php

require_once '../vendor/autoload.php';

use Vshepelev\App\Application;
use Vshepelev\App\Response\Response;
use Vshepelev\App\Response\HttpStatus;

try {
    (new Application())->handleHttpRequest();
} catch (Throwable $e) {
    (new Response($e->getMessage(), HttpStatus::SERVER_ERROR))->send();
}
