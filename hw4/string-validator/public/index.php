<?php

include __DIR__ . '/../vendor/autoload.php';

try {
    $server = new App\Http\Server();
    $server->run();
} catch (Throwable) {
    http_response_code(500);
}
