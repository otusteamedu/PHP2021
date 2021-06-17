<?php

/** @var App\Server $server */
$server = include __DIR__ . '/../bootstrap/bootstrap.php';

try {
    $server->run();
} catch (Throwable $e) {
    http_response_code(500);
}
