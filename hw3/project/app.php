<?php
require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'vendor', 'autoload.php']);

$app = new \App\Classes\App($argv);
$app->run();
