<?php

require_once '../vendor/autoload.php';

use Vshepelev\App\Request;
use Vshepelev\App\Application;
use Vshepelev\App\Response\Response;
use Vshepelev\App\Response\HttpStatus;

try {
    $application = new Application();
    $request = Request::capture();

    $response = $application->handle($request);
    $response->send();
} catch (Throwable $e) {
    (new Response($e->getMessage(), HttpStatus::SERVER_ERROR))->send();
}