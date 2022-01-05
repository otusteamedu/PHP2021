<?php
require_once __DIR__ . '/vendor/autoload.php';

try {
    $app = new \App\App();
    $app->checkData();
}
catch(\Exception $e){
    \App\Response::replyWithError($e->getMessage());
}