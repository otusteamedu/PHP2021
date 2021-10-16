<?php

require __DIR__ . '/../vendor/autoload.php';

use Artemanoshin\Isibia\MyLibComposer;

$greetingUser = new MyLibComposer('Превед', 'Медвед');
$greetingUser->sayHi();
