<?php

require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

use App\App;

$app = new App();

try {
    $emailAddressList = [
        'aaaavs@yandex.ru',
        'andfbne@domen-domenovich.zone',
    ];

    $response = $app->run($emailAddressList);

    echo $response->getMessage() . '<br>';
} catch (Exception $e) {
    echo $e->getMessage();
}
