<?php
include "../vendor/autoload.php";
$builder = new \DI\ContainerBuilder();

$builder->useAutowiring(true);
$builder->useAnnotations(true);

return $builder->build();