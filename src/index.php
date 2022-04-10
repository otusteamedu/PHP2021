<?php

use Ivanboriev\TrustedBrackets\Response\Response as Response;

require 'vendor/autoload.php';

$app = new \Ivanboriev\TrustedBrackets\App();


try {
    $app->run();
} catch (\Exception $exception) {
    Response::error($exception->getMessage());
}