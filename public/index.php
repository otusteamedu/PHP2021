<?php
require '../vendor/autoload.php';
require '../config/db.php';

$app = require __DIR__ . '/../bootstrap/container.php';


$app->set(\App\Classes\Interfaces\MailerInterface::class,
    DI\create(\App\Classes\Libs\MailerTwo::class));
$userManager = $app->get(\App\Classes\Services\UserManager::class);
echo $userManager->create();
$testAnnotations = $app->get(\App\Classes\Services\TestAnnotations::class);
echo $testAnnotations->answer();