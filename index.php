<?php

use App\App;
use DI\ContainerBuilder;

require_once('vendor/autoload.php');

try {
    $container = (new ContainerBuilder())->addDefinitions('config/config.php')
                                         ->build();
    $app = $container->get(App::class);
    $app->run();
} catch (Exception $e) {
    printf('Error: %s!%s', $e->getMessage(), PHP_EOL);
}
