<?php
$builder = new \DI\ContainerBuilder();
$dbConfig = require '../config/db.php';

$builder->addDefinitions($dbConfig + [
    PDO::class => DI\factory(function () use ($dbConfig) {
        return new PDO(
            'mysql:host=' . $dbConfig['DB_HOST'] . ':' . $dbConfig['DB_PORT'] .
            ';dbname='. $dbConfig['DB_NAME'], $dbConfig['DB_USER'], $dbConfig['DB_PASSWORD']);
    }),
]);

$builder->useAutowiring(true);
$builder->useAnnotations(true);

return $builder->build();