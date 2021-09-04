<?php

// require_once('../vendor/autoload.php');

// use App\App;

// try {
//     $app = new App();
//     $app->run($argv);
// } catch (Exception $e) {
//     echo $e->getMessage();
// }

$m = new Memcached();
$m->addServer('backend_3_memcached', 11211);
$m->set('testKey', 'testValue');
print_r($m->getResultMessage());
print_r('<hr />');
var_dump($m->get('testKey'));
