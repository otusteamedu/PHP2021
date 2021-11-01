<?php
require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'vendor', 'autoload.php']);

try {
    $app = new \App\Classes\App($argv);
    $app->run();
} catch (Throwable $e) {
    echo PHP_EOL . $e->getMessage() . PHP_EOL;
}
