<?php

$builder = new \DI\ContainerBuilder();

$builder->useAutowiring(true);
$builder->useAnnotations(true);

//$builder->addDefinitions(require __DIR__ . '/dependencies.php');
//$builder->addDefinitions(require __DIR__ . '/dependencies.php');

return $builder->build();