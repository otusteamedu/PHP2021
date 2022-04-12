<?php

require 'vendor/autoload.php';


$emails_for_test = [
    'kassa@volkovteatr.ru',
    'president@kremlin.ru',
    'bad@not-real.email',
    'bad@vkoontakt.com'
];

$validator = new \Otus\Domain\MXValidator;

$validator->addEmails($emails_for_test);

$validator->addEmails(['zxc@asdw.com']);

dump($validator, $validator->handle());


