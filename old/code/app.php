<?php require_once('vendor/autoload.php');

try {
    $app = new \Application();
    $result = $app->run();

    $app->resultHandler($result);
} catch (Exception $e) {
    Presentation\Response::generateBadRequestResponse($e->getMessage());
}
