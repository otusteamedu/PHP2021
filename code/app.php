<?php require_once('vendor/autoload.php');

try {
    $app = new App\Application();
    $result = $app->run();

    $app->resultHandler($result);
} catch (Exception $e) {
    App\Response::generateBadRequestResponse($e->getMessage());
}
