<?php


try {
    /** @var App\Http\Server $server */
    $server = include __DIR__ . '/../bootstrap/bootstrap.php';

    $server->run();
} catch (Throwable $e) {
    echo $e->getMessage();
    http_response_code(500);
}
