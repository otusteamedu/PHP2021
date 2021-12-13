<?php
require '../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/container.php';

$app->set(\App\Interfaces\EntityInterface::class,
    DI\create(\App\Entities\Post::class));
