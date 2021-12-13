<?php
require '../vendor/autoload.php';


$app = require __DIR__ . '/../bootstrap/container.php';

$app->set(\App\Interfaces\EntityPostInterface::class,
    DI\create(\App\Entities\Post::class));

$postMapper = $app->make(\App\DataMappers\PostMapper::class);
var_dump($postMapper->findById(3));